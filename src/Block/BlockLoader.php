<?php
/**
 * FreshApp PrettyBlocks.
 *
 * @author    FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license   GPL-3.0-or-later
 */

namespace FreshAppPrettyBlocks\Block;

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
            $class = 'FreshAppPrettyBlocks\\Block\\Custom\\' . str_replace('.php', '', $file);
            if (class_exists($class) && method_exists($class, 'getContent')) {
                try {
                    $blocks[] = $class::getContent();
                } catch (\Throwable $e) {
                    \PrestaShopLogger::addLog('[freshappprettyblocks] ' . $e->getMessage());
                }
            }
        }

        return $blocks;
    }

    /**
     * Données dynamiques d'un bloc, juste avant son rendu.
     *
     * PrestaShop appelle `hookBeforeRendering` + le code du bloc passé en camelCase
     * (`freshapp_home_modules` -> `freshappHomeModules`) : la casse ne correspond donc pas
     * au nom du fichier de classe (`FreshappHomeModules.php`). PHP résout les classes sans
     * tenir compte de la casse, mais l'autoloader, lui, cherche un fichier et le système de
     * fichiers est sensible à la casse. On retrouve donc la classe à partir des fichiers
     * présents plutôt que du nom reçu.
     */
    public static function getBlockBeforeRendering(string $blockName, ?array $params, \Context $context): array
    {
        $class = self::resolveClass(str_replace('_', '', $blockName));
        if (null !== $class && method_exists($class, 'beforeRendering')) {
            try {
                return $class::beforeRendering($params, $context);
            } catch (\Throwable $e) {
                \PrestaShopLogger::addLog('[freshappprettyblocks] ' . $e->getMessage());
            }
        }

        return [];
    }

    /**
     * Codes de hook `beforeRendering…` des blocs qui en déclarent un.
     *
     * @return string[]
     */
    public static function getBeforeRenderingHooks(): array
    {
        $hooks = [];
        foreach (self::classes() as $class) {
            if (method_exists($class, 'beforeRendering') && method_exists($class, 'getContent')) {
                $hooks[] = 'beforeRendering' . \Tools::toCamelCase($class::getContent()['code']);
            }
        }

        return $hooks;
    }

    private static function resolveClass(string $shortName): ?string
    {
        foreach (self::classes() as $class) {
            if (0 === strcasecmp(substr($class, strrpos($class, '\\') + 1), $shortName)) {
                return $class;
            }
        }

        return null;
    }

    /** @return string[] */
    private static function classes(): array
    {
        $classes = [];
        foreach (array_diff((array) scandir(self::BLOCK_DIR), ['.', '..']) as $file) {
            if (preg_match('/^[A-Z][a-zA-Z0-9]+\.php$/', (string) $file)) {
                $class = 'FreshAppPrettyBlocks\\Block\\Custom\\' . substr((string) $file, 0, -4);
                if (class_exists($class)) {
                    $classes[] = $class;
                }
            }
        }

        return $classes;
    }
}
