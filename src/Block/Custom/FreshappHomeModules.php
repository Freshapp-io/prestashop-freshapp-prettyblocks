<?php
/**
 * FreshApp PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   Proprietary - see LICENSE file
 */

namespace FreshAppPrettyBlocks\Block\Custom;

use FreshAppPrettyBlocks\Block\Extrait;

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Cartes des modules d'une catégorie : nom, accroche, compatibilité, prix.
 *
 * Pas de notation par étoiles : tant qu'aucun avis n'existe, un widget d'étoiles vides se
 * lit comme une mauvaise note. La compatibilité, elle, est lue dans la caractéristique
 * produit correspondante — la même que celle affichée sur la fiche.
 */
final class FreshappHomeModules
{
    /** Nom FR de la caractéristique qui porte la plage de compatibilité. */
    private const FEATURE_COMPAT = 'Compatibilité PrestaShop';

    public static function getContent(): array
    {
        return [
            'name' => 'Accueil — Modules',
            'description' => 'Cartes des produits d\'une catégorie (accroche, compatibilité, prix)',
            'code' => 'freshapp_home_modules',
            'tab' => 'general',
            'icon' => 'CubeIcon',
            'need_reload' => true,
            'templates' => [
                'default' => 'module:freshappprettyblocks/views/templates/blocks/home/modules.tpl',
            ],
            'config' => [
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Titre (H2)', 'default' => 'Nos modules'],
                    'intro' => ['type' => 'textarea', 'label' => 'Introduction', 'default' => ''],
                    'category_id' => ['type' => 'text', 'label' => 'ID de la catégorie', 'default' => '3'],
                    'include_children' => [
                        'type' => 'checkbox',
                        'label' => 'Inclure les produits des sous-catégories',
                        // Une catégorie racine comme « Modules PrestaShop » n'a souvent aucun
                        // produit en propre : ils vivent tous dans ses sous-catégories.
                        'default' => true,
                    ],
                    'limit' => ['type' => 'text', 'label' => 'Nombre maximum', 'default' => '12'],
                    'link_label' => ['type' => 'text', 'label' => 'Libellé du lien vers la catégorie', 'default' => ''],
                    'free_label' => ['type' => 'text', 'label' => 'Libellé des modules gratuits', 'default' => 'Gratuit'],
                    'eager' => [
                        'type' => 'checkbox',
                        'label' => 'Charger les images immédiatement (bloc visible sans défiler)',
                        'default' => false,
                    ],
                ],
            ],
        ];
    }

    public static function beforeRendering(?array $params): array
    {
        $settings = (array) ($params['settings'] ?? []);
        $context = \Context::getContext();
        $idLang = (int) $context->language->id;
        $idCategory = (int) ($settings['category_id'] ?? 3);
        $limite = max(1, min(48, (int) ($settings['limit'] ?? 12)));

        $categorie = new \Category($idCategory, $idLang);
        if (!\Validate::isLoadedObject($categorie)) {
            return ['modules' => [], 'category_url' => ''];
        }

        $idsProduits = self::idsProduits($categorie, !empty($settings['include_children']), $limite, (int) $context->shop->id);
        $idCompat = self::idCaracteristiqueCompat();
        $locale = \Tools::getContextLocale($context);
        $devise = $context->currency->iso_code;
        // Affichage du groupe client : TTC par défaut, HT pour un groupe réglé ainsi (B2B).
        $affichageHt = (bool) \Product::getTaxCalculationMethod((int) $context->customer->id);
        $traducteur = $context->getTranslator();
        $libelleTtc = $traducteur->trans('Tax included', [], 'Shop.Theme.Global');
        $libelleHt = $traducteur->trans('Tax excluded', [], 'Shop.Theme.Global');

        $modules = [];
        foreach ($idsProduits as $idProduct) {
            $produit = new \Product($idProduct, false, $idLang);
            if (!\Validate::isLoadedObject($produit)) {
                continue;
            }

            $prixTtc = (float) \Product::getPriceStatic($idProduct, true);
            $prixHt = (float) \Product::getPriceStatic($idProduct, false);
            $couverture = \Product::getCover($idProduct);

            $modules[] = [
                'name' => (string) $produit->name,
                'url' => $context->link->getProductLink($produit, null, null, null, $idLang),
                'image' => empty($couverture['id_image']) ? '' : $context->link->getImageLink(
                    (string) $produit->link_rewrite,
                    (string) $couverture['id_image'],
                    'home_default',
                ),
                'excerpt' => Extrait::depuisHtml((string) $produit->description_short, 120),
                'compat' => $idCompat ? self::valeurCaracteristique($idProduct, $idCompat, $idLang) : '',
                'is_free' => $prixTtc <= 0.0,
                // Prix principal selon l'affichage du client, l'autre mode en dessous : sans
                // mention, un visiteur ne peut pas savoir si le prix affiché est HT ou TTC.
                'price' => $prixTtc > 0.0 ? $locale->formatPrice($affichageHt ? $prixHt : $prixTtc, $devise) : '',
                'price_label' => $affichageHt ? $libelleHt : $libelleTtc,
                'price_secondary' => $prixTtc > 0.0 ? $locale->formatPrice($affichageHt ? $prixTtc : $prixHt, $devise) : '',
                'price_secondary_label' => $affichageHt ? $libelleTtc : $libelleHt,
            ];
        }

        return [
            'modules' => $modules,
            'category_url' => $context->link->getCategoryLink($categorie, null, $idLang),
        ];
    }

    /**
     * Produits actifs et visibles de la catégorie, et de ses sous-catégories si demandé.
     *
     * Ordre de création : c'est l'ordre du catalogue, stable d'un rendu à l'autre, là où la
     * position n'a de sens qu'à l'intérieur d'une même catégorie.
     *
     * @return int[]
     */
    private static function idsProduits(\Category $categorie, bool $avecEnfants, int $limite, int $idShop): array
    {
        $filtreCategorie = $avecEnfants
            ? 'c.nleft >= ' . (int) $categorie->nleft . ' AND c.nright <= ' . (int) $categorie->nright
            : 'c.id_category = ' . (int) $categorie->id;

        $lignes = \Db::getInstance()->executeS(
            'SELECT DISTINCT ps.id_product
             FROM ' . _DB_PREFIX_ . 'category c
             INNER JOIN ' . _DB_PREFIX_ . 'category_product cp ON cp.id_category = c.id_category
             INNER JOIN ' . _DB_PREFIX_ . 'product_shop ps
                ON ps.id_product = cp.id_product AND ps.id_shop = ' . $idShop . '
             WHERE ' . $filtreCategorie . '
               AND ps.active = 1 AND ps.visibility IN ("both", "catalog")
             ORDER BY ps.id_product ASC
             LIMIT ' . $limite,
        ) ?: [];

        return array_map('intval', array_column($lignes, 'id_product'));
    }

    private static function idCaracteristiqueCompat(): int
    {
        return (int) \Db::getInstance()->getValue(
            'SELECT id_feature FROM ' . _DB_PREFIX_ . 'feature_lang
             WHERE name = "' . pSQL(self::FEATURE_COMPAT) . '"',
        );
    }

    private static function valeurCaracteristique(int $idProduct, int $idFeature, int $idLang): string
    {
        return (string) \Db::getInstance()->getValue(
            'SELECT fvl.value
             FROM ' . _DB_PREFIX_ . 'feature_product fp
             INNER JOIN ' . _DB_PREFIX_ . 'feature_value_lang fvl
                ON fvl.id_feature_value = fp.id_feature_value AND fvl.id_lang = ' . $idLang . '
             WHERE fp.id_product = ' . $idProduct . ' AND fp.id_feature = ' . $idFeature,
        );
    }
}
