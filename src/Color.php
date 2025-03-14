<?php
    /**
     *
     *   ______  _   _ ______  _
     *   | ___ \| | | || ___ \| |
     *   | |_/ /| |_| || |_/ /| |      ___    __ _   __ _   ___  _ __
     *   |  __/ |  _  ||  __/ | |     / _ \  / _` | / _` | / _ \| '__|
     *   | |    | | | || |    | |____| (_) || (_| || (_| ||  __/| |
     *   \_|    \_| |_/\_|    \_____/ \___/  \__, | \__, | \___||_|
     *                                        __/ |  __/ |
     *                                       |___/  |___/
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

    namespace PHPLogger;

    use PHPLogger\AnsiCodes\TerminalFontTypes;

    /**
     * 颜色类
     */
    class Color implements ColorInterface {

        /**
         * 构造函数执行后返回的结果
         * @var string
         */
        private string $finalData;

        /**
         * 构造函数 返回一个带颜色的字符串
         * @param string $data 要输出的数据
         * @param string|null $terminalFontColor 终端字体颜色
         * @param string|null $terminalForegroundColor 终端字体背景颜色
         * @param array|null $terminalFontTypes 终端字体类型
         */
        public function __construct(
            string $data = "Hello World!",
            string|null $terminalFontColor = "Default",
            string|null $terminalForegroundColor = "Default",
            array|null $terminalFontTypes = null
        ) {
            $this->finalData = self::get(
                $data,
                $terminalFontColor,
                $terminalForegroundColor,
                $terminalFontTypes
            );
        }

        /**
         * 返回最终的结果
         * @return string
         */
        public function __toString() {
            return $this->finalData;
        }

        /**
         * 返回一个带颜色的字符串
         * @param string $data 要输出的数据
         * @param string|null $terminalFontColor 终端字体颜色
         * @param string|null $terminalForegroundColor 终端字体背景颜色
         * @param array|null $terminalFontTypes 终端字体类型
         */
        public static function get(
            string $data = "Hello World!",
            string|null $terminalFontColor = "Default",
            string|null $terminalForegroundColor = "Default",
            array|null $terminalFontTypes = null
        ) :string {
            $terminalFontColor = ucfirst(strtolower($terminalFontColor));
            $terminalForegroundColor = ucfirst(strtolower($terminalForegroundColor));

            $finalData = "\033[";
            $finalData .= defined("PHPLogger\AnsiCodes\TerminalFontColors::$terminalFontColor")
                ? constant("PHPLogger\AnsiCodes\TerminalFontColors::$terminalFontColor")->value.';'
                : $terminalFontColor.';';

            $finalData .= defined("PHPLogger\AnsiCodes\TerminalBackgroundColor::$terminalForegroundColor")
                ? constant("PHPLogger\AnsiCodes\TerminalBackgroundColor::$terminalForegroundColor")->value
                : $terminalFontColor;

            if (!empty($terminalFontTypes)) {
                foreach ($terminalFontTypes as $terminalFontType) {
                    if (!is_string($terminalFontType)) continue;

                    $terminalFontType = ucfirst(strtolower($terminalFontType));
                    $finalData .= defined("PHPLogger\AnsiCodes\TerminalFontTypes::$terminalFontType")
                        ? ';' . constant("PHPLogger\AnsiCodes\TerminalFontTypes::$terminalFontType")->value
                        : ';' . $terminalFontType;
                }
            }

            $finalData .= 'm' . $data . "\033[" . TerminalFontTypes::End->value . 'm';
            return $finalData;
        }

        /**
         * 在Windows平台下获取Ansi Code
         * @return false|string
         */
        public static function getAnsiCodeForWindows():false|string {
            // 解析输出以获取构建号
            if (preg_match('/build (\d+) \(/',php_uname('v'),$matches)) $build = $matches[1];
            else return false;

            // 检查 ConsoleHost v2 是否可用
            if ($build >= 10586) {
                $isV2 = true;
                // 检查注册表项 ForceV2 的值
                $regOutput = [];
                exec('reg query HKCU\\Console /v ForceV2',$regOutput);
                foreach ($regOutput as $line) {
                    if (str_contains($line,'0x0')) {
                        $isV2 = false;
                        break;
                    }
                }
            } else $isV2 = false;

            if ($isV2) {
                exec("for /f %a in ('echo prompt \$E ^| cmd') do echo %a", $promptOutput);
                return $promptOutput[count($promptOutput)-1];
            } else return false;
        }

        /**
         * 返回终端光标动作代码
         * @param string $terminalCursorType 终端光标动作类型
         * @param string|int ...$terminalCursorArgs 终端光标动作参数
         * @return string
         */
        public static function terminalCursorAction(string $terminalCursorType,string|int ...$terminalCursorArgs):string {
            if (defined("PHPLogger\AnsiCodes\TerminalCursorTypes::$terminalCursorType")) {
                $terminalCursorTypeData = explode(',',constant("PHPLogger\AnsiCodes\TerminalCursorTypes::$terminalCursorType")->value);
                $terminalCursorActionData = $terminalCursorTypeData[0];

                if (count($terminalCursorTypeData) > 1) {
                    $terminalCursorTypeArgs = array_slice($terminalCursorTypeData,1);
                    $terminalCursorActionData = str_replace($terminalCursorTypeArgs,$terminalCursorArgs,$terminalCursorActionData);
                }

                return "\033[" . $terminalCursorActionData;
            } else return "\033[" . $terminalCursorType;
        }
    }
