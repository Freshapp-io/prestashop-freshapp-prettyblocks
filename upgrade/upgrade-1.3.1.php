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
 * 1.3.1 — bloc « Modules » de l'accueil : prix HT et TTC affichés avec leur mention.
 *
 * Rien n'est à migrer en base. Ce fichier existe pour que PrestaShop reconnaisse
 * la montée de version et enregistre le nouveau numéro au lieu de garder l'ancien.
 */
function upgrade_module_1_3_1($module): bool
{
    return true;
}
