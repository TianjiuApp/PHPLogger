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

    require_once __DIR__ . '/../vendor/autoload.php';

    use PHPLogger\Color;

    // 其中的Red、White等颜色代码可以从AnsiCodes中查看
    echo new Color("Hello World!","Cyan","Default",["Blink","Bold"]);

    echo PHP_EOL;

    // new Color() 和 Color::get() 的效果是相等的
    echo Color::get("Hello World!","Red","White",["Bold"]);

    // 这个函数可以控制其鼠标/键盘的动作，可以到AnsiCodes/TerminalCursorTypes.php中查看更多示例
    echo Color::terminalCursorAction("upMoveCursor",1);
    echo Color::terminalCursorAction("leftMoveCursor",6);

    sleep(2);

