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
    
    enum LoggerStyles :int {
        /** 普通日志类别 */
        case Info = 1;

        /** 警告日志类别 */
        case Warning = 2;

        /** 错误日志类别 */
        case Error = 3;

        /** 调试日志类别 */
        case Debug = 4;

        /** 通知日志类别 */
        case Notice = 5;

        /** 紧急日志类别 */
        case Critical = 6;

        /** 无样式日志类别 */
        case NoneStyle = 0;
    }
