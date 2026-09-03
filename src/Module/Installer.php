<?php
/**
 * FreshApp Preta PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   Proprietary - see LICENSE file
 */

namespace FreshAppPretaBlocks\Module;

if (!defined('_PS_VERSION_')) {
    exit;
}

class Installer
{
    protected $module;

    public function __construct(\Freshapppretaprettyblocks $module)
    {
        $this->module = $module;
    }

    public function run(): bool
    {
        return $this->installHooks();
    }

    private function installHooks(): bool
    {
        return $this->module->registerHook('ActionRegisterBlock')
            && $this->module->registerHook('displayHeader');
    }
}
