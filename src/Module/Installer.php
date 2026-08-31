<?php

namespace FreshAppPretaBlocks\Module;

use Freshapppretaprettyblocks;

class Installer
{
    protected $module;

    public function __construct(Freshapppretaprettyblocks $module)
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
