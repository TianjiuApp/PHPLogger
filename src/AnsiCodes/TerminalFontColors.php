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

    enum TerminalFontColors: string {
        case Black = "30";
        case Red = "31";
        case Green = "32";
        case Yellow = "33";
        case Blue = "34";
        case Magenta = "35";
        case Cyan = "36";
        case White = "37";
        case Default = "39";
    }

