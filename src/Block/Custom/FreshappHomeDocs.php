<?php
/**
 * FreshApp PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   Proprietary - see LICENSE file
 */

namespace FreshAppPrettyBlocks\Block\Custom;

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Liens vers les pages de documentation d'une catégorie CMS.
 *
 * Donne aux robots un chemin direct depuis l'accueil vers chaque documentation de
 * module, au lieu de trois clics de profondeur, et au visiteur la preuve que la
 * documentation existe avant l'achat.
 */
final class FreshappHomeDocs
{
    public static function getContent(): array
    {
        return [
            'name' => 'Accueil — Documentation',
            'description' => 'Liens vers les pages d\'une catégorie CMS (documentation des modules)',
            'code' => 'freshapp_home_docs',
            'tab' => 'general',
            'icon' => 'BookOpenIcon',
            'need_reload' => true,
            'templates' => [
                'default' => 'module:freshappprettyblocks/views/templates/front/blocks/home/docs.tpl',
            ],
            'config' => [
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Titre (H2)', 'default' => 'Documentation'],
                    'intro' => ['type' => 'textarea', 'label' => 'Introduction', 'default' => ''],
                    'cms_category_id' => ['type' => 'text', 'label' => 'ID de la catégorie CMS', 'default' => '2'],
                    'strip_prefix' => [
                        'type' => 'text',
                        'label' => 'Préfixe à retirer des titres',
                        'default' => 'Documentation — ',
                    ],
                    'link_label' => ['type' => 'text', 'label' => 'Libellé du lien vers la catégorie', 'default' => ''],
                ],
            ],
        ];
    }

    public static function beforeRendering(?array $params, \Context $context): array
    {
        $settings = (array) ($params['settings'] ?? []);
        $idLang = (int) $context->language->id;
        $idCmsCategory = (int) ($settings['cms_category_id'] ?? 2);
        $prefixe = (string) ($settings['strip_prefix'] ?? '');

        $pages = [];
        foreach ((array) \CMS::getCMSPages($idLang, $idCmsCategory, true, (int) $context->shop->id) as $page) {
            $titre = (string) $page['meta_title'];
            if ('' !== $prefixe && 0 === mb_strpos($titre, $prefixe)) {
                $titre = mb_substr($titre, mb_strlen($prefixe));
            }

            $pages[] = [
                'title' => $titre,
                'url' => $context->link->getCMSLink((int) $page['id_cms'], (string) $page['link_rewrite'], null, $idLang),
            ];
        }

        $categorie = new \CMSCategory($idCmsCategory, $idLang);

        return [
            'pages' => $pages,
            'category_url' => \Validate::isLoadedObject($categorie)
                ? $context->link->getCMSCategoryLink($categorie, null, $idLang)
                : '',
        ];
    }
}
