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

    namespace PHPLogger;
    use PHPLogger\Config\LoggerConfig;

    /**
     * PHPLogger 可用的日志接口
     */
    interface LoggerInterface {

        /**
         * 输出指定级别的日志
         * @param string $message 日志信息
         * @param string|null $category 日志类型
         * @param int $level 日志级别
         * @param LoggerConfig|null $context 日志配置对象
         * @return void
         */
        public static function returnLog(
            string $message,
            string|null $category,
            int $level,LoggerConfig|null $context = null
        ) :void;

        /**
         * 快速方法的调用
         * @param string $name
         * @param array $args
         * @return void
         */
        public static function __callStatic(string $name, array $args): void;

        /**
         * 设置全局配置
         * @param LoggerConfig $context 配置对象
         * @return void
         */
        public static function setGlobalConfig(LoggerConfig $context): void;
    }