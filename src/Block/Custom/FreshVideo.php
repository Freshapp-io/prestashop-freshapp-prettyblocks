<?php

namespace FreshAppPretaBlocks\Block\Custom;

final class FreshVideo
{
    public static function getContent(): array
    {
        return [
            'name'        => 'Vidéo',
            'description' => 'Intègre une vidéo YouTube, Vimeo, Dailymotion, PeerTube ou auto-hébergée',
            'code'        => 'freshapp_video',
            'tab'         => 'general',
            'icon'        => 'VideoCameraIcon',
            'need_reload' => false,
            'templates'   => [
                'default' => 'module:freshapppretaprettyblocks/views/templates/blocks/video.tpl',
            ],
            'config' => [
                'fields' => [
                    'source' => [
                        'type'    => 'select',
                        'label'   => 'Source',
                        'default' => 'youtube',
                        'choices' => [
                            'youtube'     => 'youtube',
                            'vimeo'       => 'vimeo',
                            'dailymotion' => 'dailymotion',
                            'peertube'    => 'peertube',
                            'self'        => 'self',
                        ],
                    ],
                    'url' => [
                        'type'    => 'text',
                        'label'   => 'URL de la vidéo (sauf auto-hébergée)',
                        'default' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    ],
                    'self_hosted_file' => [
                        'type'    => 'fileupload',
                        'label'   => 'Fichier vidéo (auto-hébergée)',
                        'path'    => '$/modules/freshapppretaprettyblocks/views/videos/',
                        'default' => ['url' => ''],
                    ],
                    'autoplay' => [
                        'type'    => 'checkbox',
                        'label'   => 'Lecture automatique',
                        'default' => false,
                    ],
                    'muted' => [
                        'type'    => 'checkbox',
                        'label'   => 'Muet',
                        'default' => false,
                    ],
                    'loop' => [
                        'type'    => 'checkbox',
                        'label'   => 'Boucle',
                        'default' => false,
                    ],
                    'height' => [
                        'type'    => 'text',
                        'label'   => 'Hauteur (ex: 480px, 56.25vw)',
                        'default' => '480px',
                    ],
                    'custom_class' => [
                        'type'    => 'text',
                        'label'   => 'Classe CSS',
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
