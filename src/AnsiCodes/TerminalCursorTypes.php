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

    namespace PHPLogger\AnsiCodes;

    /**
     * TerminalCursorTypes 类用于定义终端光标的各种操作
     *
     * 调用方式：
     *
     *
     *      Color::terminalCursorAction(string $methodName);
     *
     *
     * 如果有参数值的话：
     *
     *      // 注意：参数值必须是字符串类型
     *      Color::terminalCursorAction(string $methodName,string $arg1,string $arg2...);
     *
     *
     * 具体用法请看：
     * @link https://blog.csdn.net/zyj_zhouyongjun183/article/details/80211245
     * @link https://zhuanlan.zhihu.com/p/606984955
     */
    enum TerminalCursorTypes :string {
        /**
         * 向上移动光标
         *
         *      // n：移动的字符数
         *      Color::terminalCursorAction("upMoveCursor",$n);
         *
         */
        case upMoveCursor = "nA,n";

        /**
         * 向下移动光标
         *
         *      // n：移动的字符数
         *      Color::terminalCursorAction("downMoveCursor",$n);
         *
         */
        case downMoveCursor = "nB,n";

        /**
         * 向右移动光标
         *
         *      // n：移动的字符数
         *      Color::terminalCursorAction("rightMoveCursor",$n);
         *
         */
        case rightMoveCursor = "nC,n";

        /**
         * 向左移动光标
         *
         *      // n：移动的字符数
         *      Color::terminalCursorAction("leftMoveCursor",$n);
         *
         */
        case leftMoveCursor = "nD,n";

        /**
         * 改变光标的位置
         *
         *      // x：光标列的位置
         *      // y：光标行的位置
         *      Color::terminalCursorAction("setPos",$x,$y);
         *
         */
        case setPos = "y;xH,x,y";

        /**
         * 清屏并移动光标到左上角
         */
        case cleanScreen = "2J";

        /**
         * 清除光标所处位置右边的所有字符
         */
        case cleanRightAllLine = "K";

        /**
         * 保存光标的位置
         */
        case saveCursorPos = "s";

        /**
         * 设置光标的位置为之前保存的位置
         */
        case restoreCursorPos = "u";

        /**
         * 隐藏光标
         */
        case hideCursor = "?25l";

        /**
         * 显示光标
         */
        case showCursor = "?25h";

        // 新增控制码 2025-01-20

        /**
         * 清除光标所处位置右边的n个字符
         *
         *       // n：需删除的字符数
         *       Color::terminalCursorAction("cleanRightLine",$n);
         *
         */
        case cleanRightStr = "nX,n";

        /**
         * 清除光标所处位置左边的所有字符
         */
        case cleanLeftAllLine = "1K";

        /**
         * 清除光标所处行的所有字符且不改变光标位置
         */
        case cleanLine = "2K";

        /**
         * 清除左半屏幕的所有内容
         */
        case cleanLeftScreen = "1J";

        /**
         * 清除右半屏幕的所有内容
         */
        case cleanRightScreen = "J";

        /**
         * 锁定键盘
         */
        case lockKeyboard = "2h";

        /**
         * 解锁键盘
         */
        case unLockKeyboard = "2l";

        /**
         * 删除光标下的n行，剩余部分上移
         *
         *       // n：需删除的行数
         *       Color::terminalCursorAction("delDownLine",$n);
         *
         */
        case delDownLine = "nM,n";

        /**
         * 清除光标所处位置右边的n个字符，剩余部分左移
         *
         *       // n：需删除的字符数
         *       Color::terminalCursorAction("delRightStr",$n);
         *
         */
        case delRightStr = "nP,n";

        /**
         * 在当前光标处插入n个空格，右处的字符右移
         *
         *        // n：需插入的空格数
         *        Color::terminalCursorAction("insertSpaces",$n);
         *
         */
        case insertSpaces = "n@,n";
    }
