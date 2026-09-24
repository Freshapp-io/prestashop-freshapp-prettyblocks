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
 * Grille des catégories filles d'une catégorie, lue en base à chaque rendu.
 *
 * Sur l'accueil, c'est le principal levier de maillage vers les pages catégories : un lien
 * par besoin, avec un ancre descriptive et un extrait du texte d'introduction de la
 * catégorie. Rien n'est recopié dans le bloc : renommer ou réécrire une catégorie en
 * back-office suffit à mettre l'accueil à jour.
 */
final class FreshappHomeCategories
{
    public static function getContent(): array
    {
        return [
            'name' => 'Accueil — Catégories',
            'description' => 'Grille des sous-catégories d\'une catégorie (nom, extrait, nombre de modules)',
            'code' => 'freshapp_home_categories',
            'tab' => 'general',
            'icon' => 'Squares2X2Icon',
            'need_reload' => true,
            'templates' => [
                'default' => 'module:freshappprettyblocks/views/templates/front/blocks/home/categories.tpl',
            ],
            'config' => [
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Titre (H2)', 'default' => 'Modules par besoin'],
                    'intro' => ['type' => 'textarea', 'label' => 'Introduction', 'default' => ''],
                    'parent_id' => ['type' => 'text', 'label' => 'ID de la catégorie parente', 'default' => '3'],
                    'exclude_ids' => [
                        'type' => 'text',
                        'label' => 'ID de catégories à exclure (séparés par des virgules)',
                        'default' => '',
                    ],
                    'excerpt_length' => ['type' => 'text', 'label' => 'Longueur de l\'extrait', 'default' => '130'],
                    // Libellés portés par le bloc : chaque instance PrettyBlocks est propre à
                    // une langue, ce qui évite de dépendre des traductions front du module.
                    'count_singular' => ['type' => 'text', 'label' => 'Libellé pour 1 module', 'default' => '1 module'],
                    'count_plural' => ['type' => 'text', 'label' => 'Libellé pour plusieurs (%d = nombre)', 'default' => '%d modules'],
                ],
            ],
        ];
    }

    public static function beforeRendering(?array $params, \Context $context): array
    {
        $settings = (array) ($params['settings'] ?? []);
        $idLang = (int) $context->language->id;
        $idParent = (int) ($settings['parent_id'] ?? 3);
        $exclusions = array_map('intval', array_filter(explode(',', (string) ($settings['exclude_ids'] ?? ''))));
        $longueur = max(40, (int) ($settings['excerpt_length'] ?? 130));

        $categories = [];
        foreach ((array) \Category::getChildren($idParent, $idLang, true) as $ligne) {
            $idCategory = (int) $ligne['id_category'];
            if (in_array($idCategory, $exclusions, true)) {
                continue;
            }

            $categorie = new \Category($idCategory, $idLang);

            $categories[] = [
                'name' => (string) $categorie->name,
                'url' => $context->link->getCategoryLink($categorie, null, $idLang),
                'excerpt' => Extrait::depuisHtml((string) $categorie->description, $longueur),
                'count' => (int) \Db::getInstance()->getValue(
                    'SELECT COUNT(DISTINCT cp.id_product)
                     FROM ' . _DB_PREFIX_ . 'category_product cp
                     INNER JOIN ' . _DB_PREFIX_ . 'product_shop ps
                        ON ps.id_product = cp.id_product AND ps.id_shop = ' . (int) $context->shop->id . '
                     WHERE cp.id_category = ' . $idCategory . ' AND ps.active = 1 AND ps.visibility IN ("both", "catalog")',
                ),
            ];
        }

        return ['categories' => $categories];
    }
}
