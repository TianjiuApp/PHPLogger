<?php
    /**
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

    interface ColorInterface {

        /**
         * 构造函数 返回一个带颜色的字符串
         * @param string $data 要输出的数据
         * @param string|null $terminalFontColor 终端字体颜色
         * @param string|null $terminalForegroundColor 终端字体背景颜色
         * @param array|null $terminalFontTypes 终端字体类型
         */
        public function __construct(
            string $data,
            string|null $terminalFontColor = "default",
            string|null $terminalForegroundColor = "default",
            array|null $terminalFontTypes = null
        );

        /**
         * 主函数 返回一个带颜色的字符串
         * @param string $data 要输出的数据
         * @param string|null $terminalFontColor 字体颜色
         * @param string|null $terminalForegroundColor 字体背景颜色
         * @param array|null $terminalFontTypes 字体类型
         */
        public static function get(
            string $data,
            string|null $terminalFontColor = "Default",
            string|null $terminalForegroundColor = "Default",
            array|null $terminalFontTypes = null
        ) :string;

        /**
         * 返回终端光标动作代码
         * @param string $terminalCursorType 终端光标动作类型
         * @param string ...$terminalCursorArgs 终端光标动作参数
         * @return string
         */
        public static function terminalCursorAction(string $terminalCursorType, string ...$terminalCursorArgs) :string;

        /**
         * 在Windows平台下获取Ansi Code
         * @return false|string
         */
        public static function getAnsiCodeForWindows() :string|false;
    }