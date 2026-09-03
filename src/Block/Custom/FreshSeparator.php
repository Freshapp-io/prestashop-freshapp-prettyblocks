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

final class FreshSeparator
{
    public static function getContent(): array
    {
        return [
            'name' => 'Séparateur',
            'description' => 'Ligne de séparation configurable (hr)',
            'code' => 'freshapp_separator',
            'tab' => 'general',
            'icon' => 'MinusIcon',
            'need_reload' => false,
            'templates' => [
                'default' => 'module:freshapppretaprettyblocks/views/templates/blocks/separator.tpl',
            ],
            'config' => [
                'fields' => [
                    'style' => [
                        'type' => 'select',
                        'label' => 'Style',
                        'default' => 'solid',
                        'choices' => [
                            'solid' => 'solid',
                            'dashed' => 'dashed',
                            'dotted' => 'dotted',
                            'double' => 'double',
                            'groove' => 'groove',
                        ],
                    ],
                    'width' => [
                        'type' => 'text',
                        'label' => 'Largeur (ex: 100%, 80%, 600px)',
                        'default' => '100%',
                    ],
                    'height' => [
                        'type' => 'text',
                        'label' => 'Épaisseur (ex: 1px, 2px)',
                        'default' => '1px',
                    ],
                    'color' => [
                        'type' => 'color',
                        'label' => 'Couleur',
                        'default' => '#cccccc',
                    ],
                    'align' => [
                        'type' => 'select',
                        'label' => 'Alignement',
                        'default' => 'center',
                        'choices' => [
                            'left' => 'left',
                            'center' => 'center',
                            'right' => 'right',
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
        ];
    }
}
