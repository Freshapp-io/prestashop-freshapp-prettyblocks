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

final class FreshHtmlCode
{
    public static function getContent(): array
    {
        return [
            'name' => 'Code HTML',
            'description' => 'Injecte du HTML personnalisé',
            'code' => 'freshapp_htmlcode',
            'tab' => 'general',
            'icon' => 'CodeBracketIcon',
            'need_reload' => true,
            'templates' => [
                'default' => 'module:freshappprettyblocks/views/templates/blocks/htmlcode.tpl',
            ],
            'config' => [
                'fields' => [
                    'html_content' => [
                        'type' => 'textarea',
                        'label' => 'Code HTML',
                        'default' => 'Votre HTML ici',
                    ],
                    'width' => [
                        'type' => 'text',
                        'label' => 'Largeur (ex: 100%, 800px)',
                        'default' => '100%',
                    ],
                    'height' => [
                        'type' => 'text',
                        'label' => 'Hauteur (ex: auto, 300px)',
                        'default' => 'auto',
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
