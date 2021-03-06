<?php
namespace Helhum\ConfigLoader\Tests;

/*
 * This file is part of the helhum TYPO3 configuration loader package.
 *
 * (c) Helmut Hummel <info@helhum.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Helhum\ConfigLoader\ConfigurationLoader;
use Helhum\ConfigLoader\Reader\EnvironmentReader;
use Helhum\ConfigLoader\Reader\PhpFileReader;

/**
 * Class ConfigurationLoaderTest
 */
class ConfigurationLoaderTest extends \PHPUnit_Framework_TestCase
{
    protected $baseConfig = array(
        'key' => 'base',
        'override_key' => 'base',
        'production_key' => 'base',
        'development_key' => 'base',
        'base_key' => 'base',
    );

    /**
     * @test
     */
    public function correctlyLoadsProductionContextConfiguration()
    {
        $context = 'production';
        $configLoader = new ConfigurationLoader(
            array(
                new PhpFileReader(__DIR__ . '/Fixture/conf/default.php'),
                new PhpFileReader(__DIR__ . '/Fixture/conf/' . $context . '.php'),
            )
        );
        $result = $configLoader->load();
        $this->assertSame('production', $result['key']);
    }

    /**
     * @test
     * @expectedException \Helhum\ConfigLoader\InvalidConfigurationFileException
     */
    public function throwsExceptionOnInvalidConfigFiles()
    {
        $configLoader = new ConfigurationLoader(
            array(
                new PhpFileReader(__DIR__ . '/Fixture/conf/broken.php'),
            )
        );
        $configLoader->load();
    }

    /**
     * @test
     */
    public function correctlyLoadsDevelopmentContextConfiguration()
    {
        $context = 'development';
        $configLoader = new ConfigurationLoader(
            array(
                new PhpFileReader(__DIR__ . '/Fixture/conf/default.php'),
                new PhpFileReader(__DIR__ . '/Fixture/conf/' . $context . '.php'),
            )
        );
        $result = $configLoader->load();
        $this->assertSame('development', $result['development_key']);
    }

    /**
     * @test
     */
    public function correctlyLoadsOverrideConfiguration()
    {
        $context = 'production';
        $configLoader = new ConfigurationLoader(
            array(
                new PhpFileReader(__DIR__ . '/Fixture/conf/default.php'),
                new PhpFileReader(__DIR__ . '/Fixture/conf/' . $context . '.php'),
                new PhpFileReader(__DIR__ . '/Fixture/conf/override.php'),
            )
        );
        $result = $configLoader->load();
        $this->assertSame('override', $result['override_key']);
    }

    /**
     * @test
     */
    public function correctlyLoadsEnvironmentConfiguration()
    {
        $_ENV['CONFIG_TEST__key'] = 'environment';
        $context = 'production';
        $configLoader = new ConfigurationLoader(
            array(
                new PhpFileReader(__DIR__ . '/Fixture/conf/default.php'),
                new PhpFileReader(__DIR__ . '/Fixture/conf/' . $context . '.php'),
                new EnvironmentReader('CONFIG_TEST'),
            )
        );
        $result = $configLoader->load();
        $this->assertSame('environment', $result['key']);
    }
}
