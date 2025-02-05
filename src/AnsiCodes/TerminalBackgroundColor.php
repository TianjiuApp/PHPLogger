<?php
    /**
     * This file is part of PHPLogger.
     *
     * Licensed under The MIT License
     * For full copyright and license information, please see the "LICENSE" File
     * Redistributions of files must retain the above copyright notice.
     *
     * @author    budingxiaocai<budingxiaocai@yeah.net>
     * @copyright TianjiuApp<tianjiuapp@126.com>
     * @link      https://os.tianjiu.com.mp/PHPLogger
     * @license   https://opensource.org/license/mit MIT License
     */

    namespace PHPLogger\AnsiCodes;

    enum TerminalBackgroundColor: string {
        case Black = "40";
        case Red = "41";
        case Green = "42";
        case Yellow = "43";
        case Blue = "44";
        case Magenta = "45";
        case Cyan = "46";
        case White = "47";
        case Default = "49";
    }