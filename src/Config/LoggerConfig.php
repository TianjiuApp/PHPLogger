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

    use PHPLogger\LoggerStyles;
    use PHPLogger\Config\LoggerConfigInterface;
    use PHPLogger\Config\Default\LoggerConfig as DefaultLoggerConfig;
    use \Error;

    /**
     * Config Class for Logger
     */
    class LoggerConfig implements LoggerConfigInterface {

        /** 是否输出到终端 @var bool  */
        private bool $enabledConsoleLog;

        /** 在终端的类别配置 @var array  */
        private array $inTerminalConfig;

        /** 在日志文件中的类别配置 @var array  */
        private array $inLogFileConfig;

        /** 日志样式 @var array  */
        private array $logStyles;

        /** 所有已记录的日志文件句柄 @var array  */
        private static array $allLogFileHandles = [];

        /** 日志文件句柄 */
        private $logFileHandle = null;

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
        ) {
            $this->enabledConsoleLog = $enabledConsoleLog;
            $this->inTerminalConfig = $inTerminalConfig ?? DefaultLoggerConfig::defaultTerminalConfig;
            $this->inLogFileConfig = $inLogFileConfig ?? DefaultLoggerConfig::defaultLogFileConfig;
            $this->logStyles = $logStyles ?? DefaultLoggerConfig::defaultLogStyles;

            $this->checkFile($logFile);
            return $this;
        }

        /**
         * 检测并创建日志文件
         * @param string|null $filePath 日志文件路径
         * @throws Error
         */
        private function checkFile(string|null $filePath): void {
            if (empty($filePath)) {
                $this->logFileHandle = null;
                return;
            }

            if (in_array(realpath($filePath),self::$allLogFileHandles)) {
                $this->logFileHandle = self::$allLogFileHandles[realpath($filePath)];
                return;
            }

            $firstLine = '';
            if (file_exists($filePath)) {
                if (!is_writable($filePath)) {
                    throw new Error('Log file: ' . $filePath . ' is not writable');
                }
                if (is_dir($filePath)) {
                    throw new Error('Log file: ' . $filePath . ' is a directory');
                }
            } else if (!is_dir(dirname($filePath))) mkdir(dirname($filePath),0777,true);

            self::$allLogFileHandles[realpath($filePath)] = $this->logFileHandle;

            // 处理配置中的逻辑
            if (!empty($this->inLogFileConfig['inTitle'])) {
                if (
                    !empty($this->inLogFileConfig['logHeader']) &&
                    is_string($this->inLogFileConfig['logHeader'])
                ) $firstLine = $this->inLogFileConfig['logHeader'];

                $firstLine .= '----- ';

                if (
                    !empty($this->inLogFileConfig['inTitle']['showDate']) &&
                    is_bool($this->inLogFileConfig['inTitle']['showDate']) &&
                    $this->inLogFileConfig['inTitle']['showDate']
                ) $firstLine .= date('Y-m-d H:i:s') . ' ';

                if (
                    !empty($this->inLogFileConfig['inTitle']['category']) &&
                    is_string($this->inLogFileConfig['inTitle']['category'])
                ) $firstLine .= $this->inLogFileConfig['inTitle']['category'] . ' ';

                $firstLine .= '-----' . PHP_EOL;
            }

            $this->logFileHandle = fopen($filePath,'a');
            fwrite($this->logFileHandle,$firstLine);
        }

        /** 返回日志文件句柄 @return resource|null */
        public function getLogFileHandle() { return $this->logFileHandle; }

        /** 是否输出到终端 @return bool  */
        public function isConsoleLog(): bool { return $this->enabledConsoleLog; }

        /** 返回终端的配置 @return array */
        public function getTerminalConfig(): array { return $this->inTerminalConfig; }

        /** 返回日志文件的配置 @return array */
        public function getLogFileConfig(): array { return $this->inLogFileConfig; }

        /**
         * 返回指定的日志样式
         * @param int $level
         * @return array
         */
        public function getLogStyles(int $level = LoggerStyles::Info->value): array {
            return $this->logStyles[$level] ?? DefaultLoggerConfig::defaultLogStyles[$level] ?? ['Default','Default',null];
        }
    }
