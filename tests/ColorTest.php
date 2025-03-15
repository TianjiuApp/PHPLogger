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

    namespace PHPLogger\Tests;

    use PHPLogger\Color;
    use PHPLogger\AnsiCodes\TerminalFontColors;
    use PHPLogger\AnsiCodes\TerminalBackgroundColor;
    use PHPUnit\Framework\TestCase;

    class ColorTest extends TestCase {

        public function testGet() {
            foreach (TerminalFontColors::cases() as $color) {
                foreach (TerminalBackgroundColor::cases() as $background) {
                    $this->assertEquals(
                        "\033[" . $color->value . ";" . $background->value . ";1;2;4;5;7;8mTest\033[0m",
                        Color::get(
                            'Test',
                            $color->name,
                            $background->name,
                            ["Bold", "Dim", "Underscore", "Blink", "Reverse", "Conceal"]
                        )
                    );

                    $this->assertEquals(
                        "\033[" . $color->value . ";" . $background->value . ";1;2;4;5;7;8mTest\033[0m",
                        Color::get(
                            'Test',
                            $color->value,
                            $background->value,
                            ["Bold", "Dim", "Underscore", "Blink", "Reverse", "Conceal"]
                        )
                    );
                }
            }
        }

        public function testTerminalCursorAction() {
            $this->assertEquals(
                "\033[2J",
                Color::terminalCursorAction('cleanScreen')
            );

            $this->assertEquals(
                "\033[5A",
                Color::terminalCursorAction('upMoveCursor', 5)
            );

            $this->assertEquals(
                "\033[2;1H",
                Color::terminalCursorAction('setPos', 1, 2)
            );
        }
    }
