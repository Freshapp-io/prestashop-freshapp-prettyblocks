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

/**
 * Bandeau de réassurance : une ligne d'engagements courts.
 *
 * Ne doit contenir que des affirmations vérifiables. Compteurs de clients, notes et
 * témoignages n'ont leur place ici que lorsqu'ils existent réellement.
 */
final class FreshappHomeReassurance
{
    public static function getContent(): array
    {
        return [
            'name' => 'Accueil — Réassurance',
            'description' => 'Engagements courts en ligne (compatibilité, mises à jour, documentation…)',
            'code' => 'freshapp_home_reassurance',
            'tab' => 'general',
            'icon' => 'ShieldCheckIcon',
            'need_reload' => false,
            'templates' => [
                'default' => 'module:freshappprettyblocks/views/templates/front/blocks/home/reassurance.tpl',
            ],
            'config' => [
                'fields' => [
                    'title' => [
                        'type' => 'text',
                        'label' => 'Titre (masqué visuellement, utile à la structure)',
                        'default' => 'Nos engagements',
                    ],
                ],
            ],
            'repeater' => [
                'name' => 'Engagement',
                'nameFrom' => 'label',
                'groups' => [
                    'icon' => [
                        'type' => 'select',
                        'label' => 'Pictogramme',
                        'default' => 'check',
                        // Clé = libellé : PrettyBlocks transmet au gabarit le LIBELLÉ du choix,
                        // pas sa clé. Un libellé traduit casserait la correspondance.
                        'choices' => [
                            'check' => 'check',
                            'refresh' => 'refresh',
                            'book' => 'book',
                            'download' => 'download',
                            'shield' => 'shield',
                            'gift' => 'gift',
                        ],
                    ],
                    'label' => ['type' => 'text', 'label' => 'Engagement', 'default' => ''],
                    'text' => ['type' => 'text', 'label' => 'Précision', 'default' => ''],
                ],
            ],
        ];
    }
}
