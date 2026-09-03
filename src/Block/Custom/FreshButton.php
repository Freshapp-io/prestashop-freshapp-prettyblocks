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

final class FreshButton
{
    public static function getContent(): array
    {
        return [
            'name' => 'Bouton',
            'description' => 'Bouton entièrement personnalisable',
            'code' => 'freshapp_button',
            'tab' => 'general',
            'icon' => 'CursorArrowRaysIcon',
            'need_reload' => false,
            'templates' => [
                'default' => 'module:freshapppretaprettyblocks/views/templates/blocks/button.tpl',
            ],
            'config' => [
                'fields' => [
                    'label' => [
                        'type' => 'text',
                        'label' => 'Libellé',
                        'default' => 'Cliquez ici',
                    ],
                    'url' => [
                        'type' => 'text',
                        'label' => 'Lien (URL)',
                        'default' => '#',
                    ],
                    'target' => [
                        'type' => 'select',
                        'label' => 'Ouverture',
                        'default' => '_self',
                        'choices' => [
                            '_self' => '_self',
                            '_blank' => '_blank',
                        ],
                    ],
                    'nofollow' => [
                        'type' => 'checkbox',
                        'label' => 'Nofollow (rel="nofollow")',
                        'default' => false,
                    ],
                    'size' => [
                        'type' => 'select',
                        'label' => 'Taille',
                        'default' => 'md',
                        'choices' => [
                            'sm' => 'sm',
                            'md' => 'md',
                            'lg' => 'lg',
                            'xl' => 'xl',
                        ],
                    ],
                    'align' => [
                        'type' => 'select',
                        'label' => 'Alignement',
                        'default' => 'left',
                        'choices' => [
                            'left' => 'left',
                            'center' => 'center',
                            'right' => 'right',
                            'stretch' => 'stretch',
                        ],
                    ],
                    'text_align_stretch' => [
                        'type' => 'select',
                        'label' => 'Alignement du texte (pleine largeur)',
                        'default' => 'center',
                        'choices' => [
                            'left' => 'left',
                            'center' => 'center',
                            'right' => 'right',
                        ],
                    ],
                    'bg_color' => [
                        'type' => 'color',
                        'label' => 'Fond',
                        'default' => '#61C424',
                    ],
                    'text_color' => [
                        'type' => 'color',
                        'label' => 'Couleur texte',
                        'default' => '#ffffff',
                    ],
                    'border_color' => [
                        'type' => 'color',
                        'label' => 'Couleur bordure',
                        'default' => '#61C424',
                    ],
                    'border_width' => [
                        'type' => 'text',
                        'label' => 'Épaisseur bordure',
                        'default' => '0px',
                    ],
                    'border_radius' => [
                        'type' => 'text',
                        'label' => 'Border radius (ex: 4px, 50px)',
                        'default' => '4px',
                    ],
                    'bg_color_hover' => [
                        'type' => 'color',
                        'label' => 'Fond au survol',
                        'default' => '#4da01d',
                    ],
                    'text_color_hover' => [
                        'type' => 'color',
                        'label' => 'Texte au survol',
                        'default' => '#ffffff',
                    ],
                    'border_color_hover' => [
                        'type' => 'color',
                        'label' => 'Bordure au survol',
                        'default' => '#4da01d',
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
