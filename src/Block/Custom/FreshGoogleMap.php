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

final class FreshGoogleMap
{
    public static function getContent(): array
    {
        return [
            'name' => 'Google Maps',
            'description' => 'Intègre une carte Google Maps',
            'code' => 'freshapp_googlemap',
            'tab' => 'general',
            'icon' => 'MapPinIcon',
            'need_reload' => false,
            'templates' => [
                'default' => 'module:freshappprettyblocks/views/templates/front/blocks/googlemap.tpl',
            ],
            'config' => [
                'fields' => [
                    'address' => [
                        'type' => 'text',
                        'label' => 'Adresse ou lieu',
                        'default' => 'Tour Eiffel, Paris, France',
                    ],
                    'zoom' => [
                        'type' => 'text',
                        'label' => 'Zoom (1-20)',
                        'default' => '14',
                    ],
                    'height' => [
                        'type' => 'text',
                        'label' => 'Hauteur (ex: 400px, 50vh)',
                        'default' => '400px',
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
