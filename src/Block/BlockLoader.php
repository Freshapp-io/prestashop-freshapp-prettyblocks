<?php
/**
 * FreshApp Preta PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   Proprietary - see LICENSE file
 */

namespace FreshAppPretaBlocks\Block;

if (!defined('_PS_VERSION_')) {
    exit;
}

final class BlockLoader
{
    private const BLOCK_DIR = __DIR__ . '/Custom';

    public static function getBlocks(): array
    {
        $blocks = [];
        if (!is_dir(self::BLOCK_DIR)) {
            return $blocks;
        }
        foreach (array_diff(scandir(self::BLOCK_DIR), ['.', '..']) as $file) {
            if (!preg_match('/^[A-Z][a-zA-Z0-9]+\.php$/', $file)) {
                continue;
            }
            $class = 'FreshAppPretaBlocks\\Block\\Custom\\' . str_replace('.php', '', $file);
            if (class_exists($class) && method_exists($class, 'getContent')) {
                try {
                    $blocks[] = $class::getContent();
                } catch (\Throwable $e) {
                    \PrestaShopLogger::addLog('[freshapppretaprettyblocks] ' . $e->getMessage());
                }
            }
        }

        return $blocks;
    }

    public static function getBlockBeforeRendering(string $blockName, ?array $params): array
    {
        $class = 'FreshAppPretaBlocks\\Block\\Custom\\' . str_replace('_', '', $blockName);
        if (class_exists($class) && method_exists($class, 'beforeRendering')) {
            try {
                return $class::beforeRendering($params);
            } catch (\Throwable $e) {
                \PrestaShopLogger::addLog('[freshapppretaprettyblocks] ' . $e->getMessage());
            }
        }

        return [];
    }
}
