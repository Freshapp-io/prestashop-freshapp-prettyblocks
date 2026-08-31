<?php

namespace FreshAppPretaBlocks\Block\Custom;

final class FreshSpacer
{
    public static function getContent(): array
    {
        return [
            'name'        => 'Spacer',
            'description' => 'Ajoute un espace vertical configurable',
            'code'        => 'freshapp_spacer',
            'tab'         => 'general',
            'icon'        => 'ArrowsUpDownIcon',
            'need_reload' => false,
            'templates'   => [
                'default' => 'module:freshapppretaprettyblocks/views/templates/blocks/spacer.tpl',
            ],
            'config' => [
                'fields' => [
                    'height' => [
                        'type'    => 'text',
                        'label'   => 'Hauteur (ex: 40px, 3em, 10vh)',
                        'default' => '40px',
                    ],
                    'background_color' => [
                        'type'    => 'color',
                        'label'   => 'Couleur de fond',
                        'default' => 'transparent',
                    ],
                    'custom_class' => [
                        'type'    => 'text',
                        'label'   => 'Classe CSS personnalisée',
                        'default' => '',
                    ],
                    'custom_id' => [
                        'type'    => 'text',
                        'label'   => 'ID HTML',
                        'default' => '',
                    ],
                ],
            ],
        ];
    }
}
