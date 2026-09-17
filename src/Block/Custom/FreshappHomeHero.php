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
 * En-tête de page d'accueil : titre principal, accroche et deux appels à l'action.
 *
 * Volontairement statique, sans carrousel : un carrousel répartit le titre principal sur
 * plusieurs diapositives et alourdit le premier affichage, là où un bloc texte donne un
 * H1 unique et un LCP immédiat.
 */
final class FreshappHomeHero
{
    public static function getContent(): array
    {
        return [
            'name' => 'Accueil — En-tête',
            'description' => 'Titre principal (H1), accroche et deux boutons, sans image ni carrousel',
            'code' => 'freshapp_home_hero',
            'tab' => 'general',
            'icon' => 'SparklesIcon',
            'need_reload' => false,
            'templates' => [
                'default' => 'module:freshappprettyblocks/views/templates/blocks/home/hero.tpl',
            ],
            'config' => [
                'fields' => [
                    'kicker' => ['type' => 'text', 'label' => 'Surtitre', 'default' => 'Éditeur de modules PrestaShop'],
                    'title' => ['type' => 'text', 'label' => 'Titre principal', 'default' => 'Modules PrestaShop'],
                    'heading' => [
                        'type' => 'select',
                        'label' => 'Balise du titre',
                        'default' => 'h1',
                        // Un seul H1 par page : ce bloc le porte sur l'accueil, mais peut
                        // être réutilisé plus bas avec un H2.
                        'choices' => ['h1' => 'h1', 'h2' => 'h2'],
                    ],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Accroche', 'default' => ''],
                    'highlights' => [
                        'type' => 'text',
                        'label' => 'Points clés (séparés par « | »)',
                        'default' => '',
                    ],
                    'cta_label' => ['type' => 'text', 'label' => 'Bouton principal — libellé', 'default' => 'Voir les modules'],
                    'cta_url' => ['type' => 'text', 'label' => 'Bouton principal — lien', 'default' => '#'],
                    'cta2_label' => ['type' => 'text', 'label' => 'Bouton secondaire — libellé', 'default' => ''],
                    'cta2_url' => ['type' => 'text', 'label' => 'Bouton secondaire — lien', 'default' => ''],
                ],
            ],
        ];
    }

    /** Points clés saisis sur une ligne, séparés par « | ». */
    public static function beforeRendering(?array $params): array
    {
        $brut = (string) (((array) ($params['settings'] ?? []))['highlights'] ?? '');

        return ['highlights' => array_values(array_filter(array_map('trim', explode('|', $brut))))];
    }
}
