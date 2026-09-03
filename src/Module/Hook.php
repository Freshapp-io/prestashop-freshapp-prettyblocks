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

use FreshAppPretaBlocks\Block\BlockLoader;

class Hook
{
    private static ?self $instance = null;

    private string $hook_name;
    private \Context $context;
    private array $params;
    private \Freshapppretaprettyblocks $module;

    private function __construct()
    {
    }

    public static function execute(string $hook_name, \Freshapppretaprettyblocks $module, array $params): mixed
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        self::$instance->hook_name = $hook_name;
        self::$instance->module = $module;
        self::$instance->params = $params;
        self::$instance->context = \Context::getContext();

        return self::$instance->$hook_name($params);
    }

    public function hookdisplayHeader(array $params): void
    {
        $this->context->controller->registerStylesheet(
            'freshapppretaprettyblocks-front',
            'modules/freshapppretaprettyblocks/views/css/front.css',
            ['media' => 'all', 'priority' => 150],
        );
        $this->context->controller->registerJavascript(
            'freshapppretaprettyblocks-front',
            'modules/freshapppretaprettyblocks/views/js/front.js',
            ['position' => 'bottom', 'priority' => 150],
        );
    }

    public function hookActionRegisterBlock(array $params): array
    {
        try {
            return BlockLoader::getBlocks();
        } catch (\Throwable $e) {
            \PrestaShopLogger::addLog('[freshapppretaprettyblocks] ' . $e->getMessage());

            return [];
        }
    }
}
