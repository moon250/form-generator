<?php

namespace FormGeneratorTests;

use FormGenerator\FormLoader;
use PHPUnit\Framework\TestCase;

class FormLoaderTest extends TestCase
{
    public function testLoadFormWithArray(): void
    {
        $loader = new FormLoader();
        $loader->loadForms([
            'login' => Helpers\LoginForm::class
        ]);
        $this->assertArrayHasKey('login', $loader->getLoadedForms());
    }

    public function testLoadFormWithPhpConfigurationFile(): void
    {
        $loader = new FormLoader();
        $loader->loadForms(dirname(__DIR__) . '\tests\Helpers\config.php');
        $this->assertArrayHasKey('login', $loader->getLoadedForms());
    }

    public function testLoadFormWithJsonConfigurationFile(): void
    {
        $loader = new FormLoader();
        $loader->loadForms(dirname(__DIR__) . '\tests\Helpers\config.json');
        $this->assertArrayHasKey('login', $loader->getLoadedForms());
    }
}
