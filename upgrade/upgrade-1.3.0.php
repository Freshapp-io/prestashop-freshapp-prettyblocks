<?php
/**
 * FreshApp PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   Proprietary - see LICENSE file
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * 1.3.0 — compatibilité PrestaShop 1.7.8 (PHP 7.4) : syntaxe réservée à PHP 8 retirée.
 *
 * Rien n'est à migrer en base. Ce fichier existe pour que PrestaShop reconnaisse
 * la montée de version et enregistre le nouveau numéro au lieu de garder l'ancien.
 */
function upgrade_module_1_3_0($module): bool
{
    return true;
}
