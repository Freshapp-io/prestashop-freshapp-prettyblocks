<?php
/**
 * FreshApp Preta PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   Proprietary - see LICENSE file
 */

namespace FreshAppPretaBlocks\Block\Custom;

if (!defined('_PS_VERSION_')) {
    exit;
}

final class FreshTabs
{
    public static function getContent(): array
    {
        return [
            'name' => 'Onglets',
            'description' => 'Bloc à onglets avec contenu WYSIWYG par onglet',
            'code' => 'freshapp_tabs',
            'tab' => 'general',
            'icon' => 'RectangleStackIcon',
            'need_reload' => false,
            'insert_default_values' => true,
            'templates' => [
                'default' => 'module:freshapppretaprettyblocks/views/templates/blocks/tabs.tpl',
            ],
            'config' => [
                'fields' => [
                    'orientation' => [
                        'type' => 'select',
                        'label' => 'Orientation',
                        'default' => 'horizontal',
                        'choices' => [
                            'horizontal' => 'horizontal',
                            'vertical' => 'vertical',
                        ],
                    ],
                    'align' => [
                        'type' => 'select',
                        'label' => 'Alignement des onglets',
                        'default' => 'left',
                        'choices' => [
                            'left' => 'left',
                            'center' => 'center',
                            'right' => 'right',
                            'justify' => 'justify',
                        ],
                    ],
                    'custom_class' => [
                        'type' => 'text',
                        'label' => 'Classe CSS',
                        'default' => '',
                    ],
                    'custom_id' => [
                        'type' => 'text',
                        'label' => 'ID HTML',
                        'default' => '',
                    ],
                ],
            ],
            'repeater' => [
                'name' => 'Onglet',
                'nameFrom' => 'tab_title',
                'groups' => [
                    'tab_title' => [
                        'type' => 'text',
                        'label' => 'Titre de l\'onglet',
                        'default' => 'Onglet 1',
                    ],
                    'tab_content' => [
                        'type' => 'editor',
                        'label' => 'Contenu',
                        'default' => 'Contenu de l\'onglet',
                    ],
                ],
            ],
        ];
    }
}
