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

    use \Exception;
    use PHPLogger\Config\LoggerConfig;
    use PHPLogger\LoggerStyles;
    use PHPLogger\Color;

    date_default_timezone_set("Asia/Shanghai");

    /**
     * PHP based logger
     */
    class Logger implements LoggerInterface {

        /** 全局配置对象 @var LoggerConfig */
        private static LoggerConfig $globalConfig;

        /**
         * 输出日志到终端或写入到文件
         * @param string $message 日志信息
         * @param int $level 日志级别
         * @param LoggerConfig|null $context 配置对象
         * @return void
         */
        public static function returnLog(
            string $message,
            int $level = LoggerStyles::Info->value,
            LoggerConfig|null $context = null
        ): void {
            if (empty($context)) {
                if (empty(self::$globalConfig)) {
                    self::$globalConfig = new LoggerConfig();
                }
                $context = self::$globalConfig;
            }

            if ($level == LoggerStyles::NoneStyle->value) $rawMessageStr = $newMessageStr = $message . PHP_EOL;
            else {
                $rawMessageStr = '';
                if ($context->isShowDate()) $rawMessageStr .= "[".date("Y-m-d H:i:s")."]";
                if ($context->isShowLevel()) self::handleLevelString($rawMessageStr,$level);

                if (!$context->isShowDate() && !$context->isShowLevel()) {
                    $rawMessageStr = $message;
                } else {
                    $rawMessageStr .= " $message";
                }

                $rawMessageStr .= PHP_EOL;

                $messageStyle = $context->getLogStyles($level);

                $newMessageStr = new Color(
                    $rawMessageStr,
                    $messageStyle[0] ?? 'Default',
                    $messageStyle[1] ?? 'Default',
                    $messageStyle[2] ?? null
                );
            }

            if ($context->isCreateLogFile()) file_put_contents($context->getLogFile(),$rawMessageStr,FILE_APPEND);
            if ($context->isConsoleLog()) echo $newMessageStr;
        }

        /**
         * 处理日志级别字符串
         * @param string $data 待处理字符串
         * @param int $level 日志级别
         * @return void
         */
        private static function handleLevelString(string &$data,int $level): void {
            $levelStr = match ($level) {
                LoggerStyles::Info->value => "INFO",
                LoggerStyles::Warning->value => "WARNING",
                LoggerStyles::Error->value => "ERROR",
                LoggerStyles::Debug->value => "DEBUG",
                LoggerStyles::Notice->value => "NOTICE",
                LoggerStyles::Critical->value => "CRITICAL",
                default => "UNKNOWN"
            };
            $data .= "[$levelStr]";
        }

        public static function setGlobalConfig(LoggerConfig $config): void { self::$globalConfig = $config; }

        public static function warning(string $message,LoggerConfig|null $context = null): void { self::returnLog($message,LoggerStyles::Warning->value,$context); }

        public static function info(string $message,LoggerConfig|null $context = null): void { self::returnLog($message,LoggerStyles::Info->value,$context); }

        public static function error(string $message,LoggerConfig|null $context = null): void { self::returnLog($message,LoggerStyles::Error->value,$context); }

        public static function debug(string $message,LoggerConfig|null $context = null): void { self::returnLog($message,LoggerStyles::Debug->value,$context); }

        public static function notice(string $message,LoggerConfig|null $context = null): void { self::returnLog($message,LoggerStyles::Notice->value,$context); }

        public static function critical(string $message,LoggerConfig|null $context = null): void { self::returnLog($message,LoggerStyles::Critical->value,$context); }

        public static function noneStyle(string $message,LoggerConfig|null $context = null): void { self::returnLog($message,LoggerStyles::NoneStyle->value,$context); }
    }