<?php
/**
 * FreshApp Preta PrettyBlocks
 * Adds 7 new blocks to PrettyBlocks: Spacer, Separator, Button, Google Maps, Video, Tabs, HTML Code.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   proprietary
 */

use FreshAppPretaBlocks\Block\BlockLoader;
use FreshAppPretaBlocks\Module\Hook as FreshAppHook;
use FreshAppPretaBlocks\Module\Installer;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

class Freshapppretaprettyblocks extends Module
{
    public function __construct()
    {
        $this->name = 'freshapppretaprettyblocks';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'FreshApp.io';
        $this->dependencies = ['prettyblocks'];

        parent::__construct();

        $this->displayName = $this->trans('FreshApp Preta PrettyBlocks', [], 'Modules.Freshapppretaprettyblocks.Admin');
        $this->description = $this->trans(
            'Spacer, Separator, Button, Google Maps, Video, Tabs, HTML: new blocks for PrettyBlocks',
            [],
            'Modules.Freshapppretaprettyblocks.Admin',
        );

        $this->ps_versions_compliancy = ['min' => '1.7', 'max' => _PS_VERSION_];
    }

    public function __call(string $name, array $arguments)
    {
        try {
            if (method_exists(FreshAppHook::class, $name) && !str_contains($name, 'hookBeforeRendering')) {
                if (str_starts_with($name, 'hook')) {
                    return FreshAppHook::execute($name, $this, $arguments[0] ?? []);
                }
            } else {
                return BlockLoader::getBlockBeforeRendering(
                    str_replace('hookBeforeRendering', '', $name),
                    $arguments[0] ?? null,
                );
            }
        } catch (Throwable $e) {
            PrestaShopLogger::addLog('[freshapppretaprettyblocks] ' . $e->getMessage());
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
