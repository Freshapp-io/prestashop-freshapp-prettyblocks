<?php
/**
 * FreshApp PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   Proprietary - see LICENSE file
 */

namespace FreshAppPrettyBlocks\Module;

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Fonction Smarty {fa_pb_html} : restitue du HTML saisi dans l'éditeur d'un bloc, que le
 * gabarit ne peut pas afficher avec le seul échappement des variables. Avec purify=true (texte
 * riche), le contenu passe par le purificateur de PrestaShop, comme celui des pages CMS ; sans
 * purify (bloc « Code HTML »), il est rendu tel quel, ce qui est l'objet même du bloc.
 */
final class Html
{
    /**
     * @param array<string, mixed> $params html, purify
     */
    public static function render(array $params, $smarty = null): string
    {
        $html = (string) ($params['html'] ?? '');

        return empty($params['purify']) ? $html : (string) \Tools::purifyHTML($html);
    }
}
