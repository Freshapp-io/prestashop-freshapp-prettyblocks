<?php
/**
 * FreshApp PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   GPL-3.0-or-later
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * 1.3.2 — points relevés par le validateur Addons : gabarits rangés sous views/templates/front,
 * plus de lecture du contexte global, échappements explicites, texte riche restitué par la
 * fonction {fa_pb_html}. Le bloc « Vidéo » calcule maintenant son URL d'intégration dans un hook
 * beforeRendering : il faut l'enregistrer sur les installations existantes.
 */
function upgrade_module_1_3_2($module): bool
{
    return (new FreshAppPrettyBlocks\Module\Installer($module))->installBeforeRenderingHooks();
}
