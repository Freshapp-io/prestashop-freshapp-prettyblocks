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

class Installer
{
    protected $module;

    public function __construct(\Freshappprettyblocks $module)
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
            && $this->module->registerHook('displayHeader')
            && $this->installBeforeRenderingHooks();
    }

    /**
     * Un hook `beforeRendering<Code>` par bloc qui a besoin de données au rendu.
     *
     * PrettyBlocks n'appelle que les modules greffés sur ce hook précis : sans lui, les
     * blocs dynamiques (catégories, modules, documentation) s'afficheraient vides.
     * Public pour être rejoué par les scripts de montée de version quand un bloc arrive.
     */
    public function installBeforeRenderingHooks(): bool
    {
        foreach (\FreshAppPrettyBlocks\Block\BlockLoader::getBeforeRenderingHooks() as $hook) {
            if (!$this->module->registerHook($hook)) {
                return false;
            }
        }

        return true;
    }
}
