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

    enum TerminalFontTypes: string {
        case End = "0";
        case Bold = "1";
        case Dim = "2";
        case Underscore = "4";
        case Blink = "5";
        case Reverse = "7";
        case Conceal = "8";
    }