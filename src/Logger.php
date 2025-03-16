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
    use PHPLogger\LoggerStyles;
    use PHPLogger\Color;

    /**
     * PHP based logger
     * @method static void info(string $message, string|null $category = null, LoggerConfig|null $context = null) 输出普通级别的日志
     * @method static void warning(string $message, string|null $category = null, LoggerConfig|null $context = null) 输出警告级别的日志
     * @method static void error(string $message, string|null $category = null, LoggerConfig|null $context = null) 输出错误级别的日志
     * @method static void debug(string $message, string|null $category = null, LoggerConfig|null $context = null) 输出调试级别的日志
     * @method static void notice(string $message, string|null $category = null, LoggerConfig|null $context = null) 输出通知级别的日志
     * @method static void critical(string $message, string|null $category = null, LoggerConfig|null $context = null) 输出严重级别的日志
     * @method static void noneStyle(string $message, string|null $category = null, LoggerConfig|null $context = null) 输出无样式的日志
     * @method static void line(string $message, string|null $category = null, LoggerConfig|null $context = null) 输出分割线
     */
    class Logger implements LoggerInterface {

        /** 全局配置对象 @var LoggerConfig */
        private static LoggerConfig $globalConfig;

        /**
         * 输出日志到终端或写入到文件
         * @param string $message 日志信息
         * @param string|null $category 日志类型
         * @param int $level 日志级别
         * @param LoggerConfig|null $context 配置对象
         * @return void
         */
        public static function returnLog(
            string $message,
            string|null $category = null,
            int $level = LoggerStyles::Info->value,
            LoggerConfig|null $context = null
        ): void {
            if (empty($context)) {
                if (empty(self::$globalConfig)) {
                    self::$globalConfig = new LoggerConfig();
                }
                $context = self::$globalConfig;
            }
            
            if ($context->getLogFileHandle() !== null) {
                $logMessage = '';
                $logFileConfig = $context->getLogFileConfig();
                
                if (
                    !empty($logFileConfig['logHeader']) &&
                    is_string($logFileConfig['logHeader'])
                ) $logMessage .= $logFileConfig['logHeader'];

                if ($level == LoggerStyles::Line->value) {
                    $logMessage .= '----- ';

                    if (
                        !empty($logFileConfig['inLine']['showDate']) &&
                        is_bool($logFileConfig['inLine']['showDate'])
                    ) $logMessage .= date('Y-m-d H:i:s') . ' ';

                    if (
                        !empty($logFileConfig['inLine']['showCategory']) &&
                        !empty($category)
                    ) $logMessage .= $category . ' ';

                    $logMessage .= "$message -----" . PHP_EOL;
                } else {
                    if (
                        !empty($logFileConfig['inLine']['showDate']) &&
                        is_bool($logFileConfig['inLine']['showDate'])
                    ) $logMessage .= "[".date("Y-m-d H:i:s")."]";

                    if (
                        !empty($logFileConfig['inLine']['showCategory']) &&
                        is_bool($logFileConfig['inLine']['showCategory']) &&
                        !empty($category) && is_string($category)
                    ) $logMessage .= "[$category]";

                    if (
                        !empty($logFileConfig['inLine']['showLevel']) &&
                        is_bool($logFileConfig['inLine']['showLevel'])
                    ) $logMessage .= "[".self::handleLevelString($level)."]";

                    if (empty($logMessage)) $logMessage .= $message . PHP_EOL; else $logMessage .= " $message" . PHP_EOL;
                }

                fwrite($context->getLogFileHandle(),$logMessage);
            }
            
            if ($context->isConsoleLog()) {
                $logMessage = '';
                $terminalConfig = $context->getTerminalConfig();

                if (
                    !empty($terminalConfig['logHeader']) &&
                    is_string($terminalConfig['logHeader'])
                ) $logMessage .= $terminalConfig['logHeader'];

                if ($level == LoggerStyles::Line->value) {
                    $logMessage .= '----- ';

                    if (
                        !empty($terminalConfig['showDate']) &&
                        is_bool($terminalConfig['showDate'])
                    ) $logMessage .= date('Y-m-d H:i:s') . ' ';

                    if (
                        !empty($terminalConfig['showCategory']) &&
                        !empty($category)
                    ) $logMessage .= $category . ' ';

                    $logMessage .= "$message -----";
                } else {
                    if (
                        !empty($terminalConfig['showDate']) &&
                        is_bool($terminalConfig['showDate'])
                    ) $logMessage .= "[".date("Y-m-d H:i:s")."]";

                    if (
                        !empty($terminalConfig['showCategory']) &&
                        is_bool($terminalConfig['showCategory']) &&
                        !empty($category) && is_string($category)
                    ) $logMessage .= "[$category]";

                    if (
                        !empty($terminalConfig['showLevel']) &&
                        is_bool($terminalConfig['showLevel']) &&
                        $level !== LoggerStyles::NoneStyle->value
                    ) $logMessage .= "[".self::handleLevelString($level)."]";

                    if (empty($logMessage)) $logMessage .= $message; else $logMessage .= " $message";
                }

                if ($level !== LoggerStyles::NoneStyle->value) {
                    $messageStyle = $context->getLogStyles($level);
                    $logMessage = new Color(
                        $logMessage,
                        $messageStyle[0] ?? 'Default',
                        $messageStyle[1] ?? 'Default',
                        $messageStyle[2] ?? null
                    );
                }

                echo $logMessage . PHP_EOL;
            }
        }

        /**
         * 处理日志级别字符串
         * @param int $level 日志级别
         * @return string
         */
        private static function handleLevelString(int $level): string {
            return match ($level) {
                LoggerStyles::Info->value => "Info",
                LoggerStyles::Warning->value => "Warning",
                LoggerStyles::Error->value => "Error",
                LoggerStyles::Debug->value => "Debug",
                LoggerStyles::Notice->value => "Notice",
                LoggerStyles::Critical->value => "Critical",
                default => "Unknown"
            };
        }

        /**
         * 设置全局配置
         * @param LoggerConfig $context 配置对象
         * @return void
         */
        public static function setGlobalConfig(LoggerConfig $context): void { self::$globalConfig = $context; }

        /**
         * 快速方法的调用
         * @param string $name
         * @param array $args
         * @return void
         */
        public static function __callStatic(string $name, array $args): void {
            $level = match ($name) {
                'info' => LoggerStyles::Info->value,
                'warning' => LoggerStyles::Warning->value,
                'error' => LoggerStyles::Error->value,
                'debug' => LoggerStyles::Debug->value,
                'notice' => LoggerStyles::Notice->value,
                'critical' => LoggerStyles::Critical->value,
                'noneStyle' => LoggerStyles::NoneStyle->value,
                'line' => LoggerStyles::Line->value,
                default => false
            };

            if ($level === false) {
                throw new \Error("Call to undefined function $name()");
            }

            call_user_func_array(function (
                string $message,
                string|null $category = null,
                LoggerConfig|null $context = null
            ) use ($level): void {
                self::returnLog($message, $category, $level, $context);
            }, $args);
        }
    }