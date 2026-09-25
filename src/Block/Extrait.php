<?php
/**
 * FreshApp PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   GPL-3.0-or-later
 */

namespace FreshAppPrettyBlocks\Block;

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Extrait texte d'un contenu HTML, coupé sur un mot.
 */
final class Extrait
{
    public static function depuisHtml(string $html, int $longueur): string
    {
        $texte = trim((string) preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8')));

        if (mb_strlen($texte) <= $longueur) {
            return $texte;
        }

        $coupe = mb_substr($texte, 0, $longueur);
        $dernierEspace = mb_strrpos($coupe, ' ');

        return rtrim(false !== $dernierEspace ? mb_substr($coupe, 0, $dernierEspace) : $coupe, ' ,;:.—-') . '…';
    }
}
