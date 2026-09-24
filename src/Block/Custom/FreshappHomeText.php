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
 * Texte éditorial avec un titre H2.
 *
 * Existe pour ne pas dépendre du bloc texte natif de PrettyBlocks, qui disparaît quand
 * l'option « retirer les blocs par défaut » est activée — option qui supprime aussi le
 * chargement de tiny-slider depuis un CDN tiers sur toutes les pages.
 */
final class FreshappHomeText
{
    public static function getContent(): array
    {
        return [
            'name' => 'Texte éditorial',
            'description' => 'Titre H2 et contenu riche, pour le texte de présentation',
            'code' => 'freshapp_home_text',
            'tab' => 'general',
            'icon' => 'DocumentTextIcon',
            'need_reload' => false,
            'templates' => [
                'default' => 'module:freshappprettyblocks/views/templates/front/blocks/home/text.tpl',
            ],
            'config' => [
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Titre (H2)', 'default' => ''],
                    'content' => ['type' => 'editor', 'label' => 'Contenu', 'default' => ''],
                ],
            ],
        ];
    }
}
