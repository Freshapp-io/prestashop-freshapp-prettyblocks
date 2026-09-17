<?php
/**
 * FreshApp PrettyBlocks
 * Adds 7 new blocks to PrettyBlocks: Spacer, Separator, Button, Google Maps, Video, Tabs, HTML Code.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   proprietary
 */

use FreshAppPrettyBlocks\Block\BlockLoader;
use FreshAppPrettyBlocks\Module\Hook as FreshAppHook;
use FreshAppPrettyBlocks\Module\Installer;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

class Freshappprettyblocks extends Module
{
    public function __construct()
    {
        $this->name = 'freshappprettyblocks';
        $this->tab = 'administration';
        $this->version = '1.3.1';
        $this->author = 'FreshApp.io';
        $this->dependencies = ['prettyblocks'];

        parent::__construct();

        $this->displayName = $this->trans('FreshApp PrettyBlocks', [], 'Modules.Freshappprettyblocks.Admin');
        $this->description = $this->trans(
            'Spacer, Separator, Button, Google Maps, Video, Tabs, HTML: new blocks for PrettyBlocks',
            [],
            'Modules.Freshappprettyblocks.Admin',
        );

        $this->ps_versions_compliancy = ['min' => '1.7.8.0', 'max' => '9.99.99'];
    }

    public function __call(string $name, array $arguments)
    {
        try {
            if (method_exists(FreshAppHook::class, $name) && false === strpos($name, 'hookBeforeRendering')) {
                if (0 === strpos($name, 'hook')) {
                    return FreshAppHook::execute($name, $this, $arguments[0] ?? []);
                }
            } else {
                return BlockLoader::getBlockBeforeRendering(
                    str_replace('hookBeforeRendering', '', $name),
                    $arguments[0] ?? null,
                );
            }
        } catch (Throwable $e) {
            PrestaShopLogger::addLog('[freshappprettyblocks] ' . $e->getMessage());
        }
    }

    public function install(): bool
    {
        return parent::install() && (new Installer($this))->run();
    }

    public function uninstall(): bool
    {
        return parent::uninstall()
            && $this->unregisterHook('ActionRegisterBlock')
            && $this->unregisterHook('displayHeader');
    }
}
