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

    namespace PHPLogger\Config;

    use PHPLogger\LoggerStyles;
    use \Error;

    /**
     * Config Class for Logger
     */
    class LoggerConfig {
        /** 是否创建日志文件 @var bool  */
        private bool $enabledCreateLogFile ;

        /** 日志文件路径 @var string  */
        private string $logFile;

        /** 是否输出到终端 @var bool  */
        private bool $enabledConsoleLog;

        /** 是否显示日期 @var bool  */
        private bool $showDate;

        /** 是否显示日志级别 @var bool  */
        private bool $showLevel;

        /** 日志样式 @var array  */
        private array $logStyles;

        /** 默认日志文件路径 @var string  */
        private static string $defaultLogFile = '';

        /** 默认日志样式 @var array  */
        private const array defaultLogStyles = [
            LoggerStyles::Info->value => ['While','Default',null],
            LoggerStyles::Warning->value => ['Yellow','Default',null],
            LoggerStyles::Error->value => ['Red','Default',["Bold"]],
            LoggerStyles::Debug->value => ['Blue','Default',["Bold"]],
            LoggerStyles::Notice->value => ['Green','Default',["Bold"]],
            LoggerStyles::Critical->value => ['Red','Default',null],
        ];

        /**
         * 设置Logger配置
         * @param bool $enabledCreateLogFile 是否创建日志文件
         * @param string $logFile 日志文件路径
         * @param bool $enabledConsoleLog 是否输出到终端
         * @param bool $showDate 是否显示日期
         * @param bool $showLevel 是否显示日志级别
         * @param array $logStyles 日志样式
         */
        public function __construct(
            bool $enabledCreateLogFile = true,
            string $logFile = '',
            bool $enabledConsoleLog = true,
            bool $showDate = true,
            bool $showLevel = true,
            array $logStyles = self::defaultLogStyles
        ) {
            $this->enabledCreateLogFile = $enabledCreateLogFile;
            $this->enabledConsoleLog = $enabledConsoleLog;
            $this->showDate = $showDate;
            $this->showLevel = $showLevel;
            $this->logStyles = $logStyles;

            if ($enabledCreateLogFile) {
                if (!empty($logFile)) {
                    $this->logFile = $logFile;
                    $this->addFile($logFile);
                } else {
                    if (empty(self::$defaultLogFile)) {
                        $this->logFile = self::$defaultLogFile = getcwd() . '/logs/log-' . date('Y-m-d-H-i') . '.log';
                    } else $this->logFile = self::$defaultLogFile;
                    $this->addFile(self::$defaultLogFile);
                }
            }

            return $this;
        }

        /**
         * 检测并创建日志文件
         * @param string $filePath 日志文件路径
         * @throws Error
         */
        private function addFile(string $filePath): void {
            $firstLine = '-----' . date('Y-m-d H:i:s') . ' ' . basename(__FILE__) . '-----' . PHP_EOL;

            if (file_exists($filePath)) {
                if (!is_writable($filePath)) {
                    $this->enabledCreateLogFile = false;
                    throw new Error('Log file: ' . $filePath . ' is not writable');
                }
                if (is_dir($filePath)) {
                    $this->enabledCreateLogFile = false;
                    throw new Error('Log file: ' . $filePath . ' is a directory');
                }

                file_put_contents($filePath,PHP_EOL . $firstLine,FILE_APPEND);
            } else {
                if (!is_dir(dirname($filePath))) mkdir(dirname($filePath),0777,true);
                file_put_contents($filePath,$firstLine);
            }
        }

        /** 是否创建日志文件 @return bool  */
        public function isCreateLogFile(): bool { return $this->enabledCreateLogFile; }

        /** 日志文件路径 @return string  */
        public function getLogFile(): string { return $this->logFile; }

        /** 是否输出到终端 @return bool  */
        public function isConsoleLog(): bool { return $this->enabledConsoleLog; }

        /** 是否显示日期 @return bool  */
        public function isShowDate(): bool { return $this->showDate; }

        /** 是否显示日志级别 @return bool  */
        public function isShowLevel(): bool { return $this->showLevel; }

        /** 返回指定的日志样式 @return array  */
        public function getLogStyles(int $level = LoggerStyles::Info->value): array {
            return $this->logStyles[$level] ?? self::defaultLogStyles[$level] ?? ['Default','Default',null];
        }
    }