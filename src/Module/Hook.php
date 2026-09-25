<?php
/**
 * FreshApp PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   GPL-3.0-or-later
 */

namespace FreshAppPrettyBlocks\Module;

if (!defined('_PS_VERSION_')) {
    exit;
}

use FreshAppPrettyBlocks\Block\BlockLoader;

class Hook
{
    private static ?self $instance = null;

    private \Context $context;

    private function __construct()
    {
    }

    public static function execute(string $hook_name, \Freshappprettyblocks $module, array $params)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        self::$instance->context = $module->contexte();

        return self::$instance->$hook_name($params);
    }

    public function hookdisplayHeader(array $params): void
    {
        $this->context->controller->registerStylesheet(
            'freshappprettyblocks-front',
            'modules/freshappprettyblocks/views/css/front.css',
            ['media' => 'all', 'priority' => 150],
        );
        $this->context->controller->registerJavascript(
            'freshappprettyblocks-front',
            'modules/freshappprettyblocks/views/js/front.js',
            ['position' => 'bottom', 'priority' => 150],
        );
    }

    public function hookActionRegisterBlock(array $params): array
    {
        try {
            return BlockLoader::getBlocks();
        } catch (\Throwable $e) {
            \PrestaShopLogger::addLog('[freshappprettyblocks] ' . $e->getMessage());

            return [];
        }
    }
}
