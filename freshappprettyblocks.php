<?php
/**
 * FreshApp PrettyBlocks
 * Adds 7 new blocks to PrettyBlocks: Spacer, Separator, Button, Google Maps, Video, Tabs, HTML Code.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   GPL-3.0-or-later
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
        $this->version = '1.3.3';
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

        $this->registerSmartyFunction();
    }

    /**
     * Fonction Smarty {fa_pb_html} (voir Html). Le constructeur d'un module s'exécute plusieurs
     * fois par requête et Smarty lève une exception à la seconde inscription d'un même nom : on
     * teste d'abord, et rien ne doit jamais empêcher le module de se charger.
     */
    private function registerSmartyFunction(): void
    {
        $smarty = $this->context->smarty ?? null;
        if (!is_object($smarty) || !method_exists($smarty, 'registerPlugin') || isset($smarty->registered_plugins['function']['fa_pb_html'])) {
            return;
        }
        try {
            $smarty->registerPlugin('function', 'fa_pb_html', [FreshAppPrettyBlocks\Module\Html::class, 'render']);
        } catch (Throwable $e) {
            PrestaShopLogger::addLog('[freshappprettyblocks] ' . $e->getMessage());
        }
    }

    /** Module::$context est protégé : relais pour les classes du module. */
    public function contexte(): Context
    {
        return $this->context;
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
                    $this->context,
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
