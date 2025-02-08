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

    namespace PHPLogger\Config;
    use PHPLogger\Config\Default\LoggerConfig as DefaultLoggerConfig;
    use PHPLogger\LoggerStyles;

    interface LoggerConfigInterface {
        /**
         * 设置Logger配置
         * @param bool $enabledConsoleLog 是否输出到终端
         * @param array|null $inTerminalConfig 在终端的类别配置
         * @param array|null $inLogFileConfig 在日志文件中的类别配置
         * @param string|null $logFile 日志文件路径
         * @param array|null $logStyles 日志样式
         */
        public function __construct(
            bool $enabledConsoleLog = true,
            array|null $inTerminalConfig = DefaultLoggerConfig::defaultTerminalConfig,
            array|null $inLogFileConfig = DefaultLoggerConfig::defaultLogFileConfig,
            string|null $logFile = null,
            array|null $logStyles = DefaultLoggerConfig::defaultLogStyles
        );

        /** 返回日志文件句柄 @return resource|null */
        public function getLogFileHandle();

        /** 是否输出到终端 @return bool  */
        public function isConsoleLog(): bool;

        /** 返回终端的配置 @return array */
        public function getTerminalConfig(): array;

        /** 返回日志文件的配置 @return array */
        public function getLogFileConfig(): array;

        /**
         * 返回指定的日志样式
         * @param int $level
         * @return array
         */
        public function getLogStyles(int $level = LoggerStyles::Info->value): array;
    }