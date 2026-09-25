<?php
/**
 * FreshApp PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   GPL-3.0-or-later
 */

namespace FreshAppPrettyBlocks\Block\Custom;

if (!defined('_PS_VERSION_')) {
    exit;
}

final class FreshVideo
{
    public static function getContent(): array
    {
        return [
            'name' => 'Vidéo',
            'description' => 'Intègre une vidéo YouTube, Vimeo, Dailymotion, PeerTube ou auto-hébergée',
            'code' => 'freshapp_video',
            'tab' => 'general',
            'icon' => 'VideoCameraIcon',
            'need_reload' => false,
            'templates' => [
                'default' => 'module:freshappprettyblocks/views/templates/front/blocks/video.tpl',
            ],
            'config' => [
                'fields' => [
                    'source' => [
                        'type' => 'select',
                        'label' => 'Source',
                        'default' => 'youtube',
                        'choices' => [
                            'youtube' => 'youtube',
                            'vimeo' => 'vimeo',
                            'dailymotion' => 'dailymotion',
                            'peertube' => 'peertube',
                            'self' => 'self',
                        ],
                    ],
                    'url' => [
                        'type' => 'text',
                        'label' => 'URL de la vidéo (sauf auto-hébergée)',
                        'default' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    ],
                    'self_hosted_file' => [
                        'type' => 'fileupload',
                        'label' => 'Fichier vidéo (auto-hébergée)',
                        'path' => '$/modules/freshappprettyblocks/views/videos/',
                        'default' => ['url' => ''],
                    ],
                    'autoplay' => [
                        'type' => 'checkbox',
                        'label' => 'Lecture automatique',
                        'default' => false,
                    ],
                    'muted' => [
                        'type' => 'checkbox',
                        'label' => 'Muet',
                        'default' => false,
                    ],
                    'loop' => [
                        'type' => 'checkbox',
                        'label' => 'Boucle',
                        'default' => false,
                    ],
                    'height' => [
                        'type' => 'text',
                        'label' => 'Hauteur (ex: 480px, 56.25vw)',
                        'default' => '480px',
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

    /**
     * URL d'intégration de la vidéo, calculée ici plutôt que dans le gabarit : les expressions
     * régulières d'extraction de l'identifiant y étaient illisibles, et les paramètres de l'URL
     * (lecture automatique, sourdine, boucle) y étaient échappés deux fois.
     *
     * @param array<string, mixed>|null $params
     *
     * @return array{embed_url: string}
     */
    public static function beforeRendering(?array $params, \Context $context): array
    {
        $settings = (array) ($params['settings'] ?? []);
        $source = (string) ($settings['source'] ?? 'youtube');
        $url = (string) ($settings['url'] ?? '');
        $options = [];

        switch ($source) {
            case 'youtube':
                $base = 'https://www.youtube.com/embed/'
                    . preg_replace('#.*(?:youtu\.be/|v/|u/\w/|embed/|shorts/|watch\?v=)([^\#&\?]*).*#', '$1', $url);
                $options = ['autoplay' => 'autoplay', 'muted' => 'mute', 'loop' => 'loop'];
                break;
            case 'vimeo':
                $base = 'https://player.vimeo.com/video/'
                    . preg_replace('#.*vimeo\.com/(?:video/)?(\d+).*#', '$1', $url);
                $options = ['autoplay' => 'autoplay', 'muted' => 'muted', 'loop' => 'loop'];
                break;
            case 'dailymotion':
                $base = 'https://www.dailymotion.com/embed/video/'
                    . preg_replace('#.*dailymotion\.com/(?:video/)?([a-zA-Z0-9]+).*#', '$1', $url);
                $options = ['autoplay' => 'autoplay', 'muted' => 'mute', 'loop' => 'loop'];
                break;
            case 'peertube':
                return ['embed_url' => str_replace('/watch/', '/embed/', $url)];
            default:
                return ['embed_url' => ''];
        }

        $query = [];
        foreach ($options as $reglage => $parametre) {
            if (!empty($settings[$reglage])) {
                $query[] = $parametre . '=1';
            }
        }

        return ['embed_url' => $base . ($query ? '?' . implode('&', $query) : '')];
    }
}
