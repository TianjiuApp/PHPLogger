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
    use PHPLogger\Config\LoggerConfig;

    /**
     * PHPLogger 可用的日志接口
     */
    interface LoggerInterface {

        /**
         * 输出指定级别的日志，下面函数的基础实现
         * @param string $message 日志信息
         * @param int $level 日志级别
         * @param LoggerConfig|null $context 日志配置对象
         * @return void
         */
        public static function returnLog(string $message,int $level,LoggerConfig|null $context = null) :void;

        /**
         * 输出警告级别的日志
         * @param string $message 日志信息
         * @param LoggerConfig|null $context 日志配置对象
         * @return void
         */
        public static function warning(string $message,LoggerConfig|null $context = null) :void;

        /**
         * 输出错误级别的日志
         * @param string $message 日志信息
         * @param LoggerConfig|null $context 日志配置对象
         * @return void
         */
        public static function error(string $message,LoggerConfig|null $context = null) :void;

        /**
         * 输出普通级别的日志
         * @param string $message 日志信息
         * @param LoggerConfig|null $context 日志配置对象
         * @return void
         */
        public static function info(string $message,LoggerConfig|null $context = null) :void;

        /**
         * 输出调试级别的日志
         * @param string $message 日志信息
         * @param LoggerConfig|null $context 日志配置对象
         * @return void
         */
        public static function debug(string $message,LoggerConfig|null $context = null) :void;

        /**
         * 输出严重级别的日志
         * @param string $message 日志信息
         * @param LoggerConfig|null $context 日志配置对象
         * @return void
         */
        public static function critical(string $message,LoggerConfig|null $context = null) :void;

        /**
         * 输出通知日志
         * @param string $message 日志信息
         * @param LoggerConfig|null $context 日志配置对象
         * @return void
         */
        public static function notice(string $message,LoggerConfig|null $context = null) :void;

        /**
         * 输出无样式的日志
         * @param string $message 日志信息
         * @param LoggerConfig|null $context 日志配置对象
         * @return void
         */
        public static function noneStyle(string $message,LoggerConfig|null $context = null) :void;

        /**
         * 设置全局配置
         * @param LoggerConfig $config 配置对象
         * @return void
         */
        public static function setGlobalConfig(LoggerConfig $config): void;
    }