<?php
    /**
     *
     *  ______  _   _ ______  _
     *  | ___ \| | | || ___ \| |
     *  | |_/ /| |_| || |_/ /| |      ___    __ _   __ _   ___  _ __
     *  |  __/ |  _  ||  __/ | |     / _ \  / _` | / _` | / _ \| '__|
     *  | |    | | | || |    | |____| (_) || (_| || (_| ||  __/| |
     *  \_|    \_| |_/\_|    \_____/ \___/  \__, | \__, | \___||_|
     *                                       __/ |  __/ |
     *                                      |___/  |___/
     *
     * This file is part of PHPLogger.
     *
     * Licensed under The MIT License
     * For full copyright and license information, please see the "LICENSE" File
     * Redistributions of files must retain the above copyright notice.
     *
     * @author    budingxiaocai<budingxiaocai@yeah.net>
     * @copyright TianjiuApp Team
     * @link      https://os.tianjiu.com.mp/PHPLogger
     * @license   MIT License
     */


    namespace PHPLogger\Tests\Config;

    use PHPLogger\Config\LoggerConfig;
    use PHPUnit\Framework\TestCase;
    use PHPLogger\LoggerStyles;

    class LoggerConfigTest extends TestCase {

        public function testIsConsoleLog() {
            $config = new LoggerConfig(true);
            $this->assertTrue($config->isConsoleLog());
        }

        public function testGetTerminalConfig() {
            $config = new LoggerConfig(true, ['Test']);
            $this->assertEquals(['Test'], $config->getTerminalConfig());
        }

        public function testGetLogStyles() {
            $config = new LoggerConfig(true, null, null ,null,
                [LoggerStyles::Info->value => ['Test']]
            );
            $this->assertEquals(['Test'], $config->getLogStyles());
        }

        public function testGetLogFileConfig() {
            $config = new LoggerConfig(true, null, ['Test']);
            $this->assertEquals(['Test'], $config->getLogFileConfig());
        }
    }
