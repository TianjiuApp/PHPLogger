<?php
    /**
     *
     * ______  _   _ ______  _
     * | ___ \| | | || ___ \| |
     * | |_/ /| |_| || |_/ /| |      ___    __ _   __ _   ___  _ __
     * |  __/ |  _  ||  __/ | |     / _ \  / _` | / _` | / _ \| '__|
     * | |    | | | || |    | |____| (_) || (_| || (_| ||  __/| |
     * \_|    \_| |_/\_|    \_____/ \___/  \__, | \__, | \___||_|
     *                                      __/ |  __/ |
     *                                     |___/  |___/
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

    namespace PHPLogger\Config\Default;

    use PHPLogger\LoggerStyles;

    class LoggerConfig {

        /** 默认日志样式 @var array  */
        public const defaultLogStyles = [
            LoggerStyles::Info->value => ['White','Default',null],
            LoggerStyles::Warning->value => ['Yellow','Default',null],
            LoggerStyles::Error->value => ['Red','Default',["Bold"]],
            LoggerStyles::Debug->value => ['Blue','Default',["Bold"]],
            LoggerStyles::Notice->value => ['Green','Default',["Bold"]],
            LoggerStyles::Critical->value => ['Red','Default',null],
            LoggerStyles::Line->value => ['White','Default',null]
        ];

        public const defaultTerminalConfig = [
            "showDate" => true,
            "showLevel" => true,
            "showCategory" => true,
            "logHeader" => null
        ];

        public const defaultLogFileConfig = [
            "logHeader" => "> ",
            "inTitle" => [
                "showDate" => true,
                "category" => "Main"
            ],
            "inLine" => [
                "showDate" => true,
                "showLevel" => true,
                "showCategory" => false
            ]
        ];
    }