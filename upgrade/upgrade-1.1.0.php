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
 * Blocs de page d'accueil (freshapp_home_*) : enregistre les hooks beforeRendering des
 * blocs dynamiques, sans lesquels ils s'afficheraient vides.
 */
function upgrade_module_1_1_0($module)
{
    return (new FreshAppPrettyBlocks\Module\Installer($module))->installBeforeRenderingHooks();
}
