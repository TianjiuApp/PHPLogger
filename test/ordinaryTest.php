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

    require_once __DIR__ . '/../vendor/autoload.php';
    use PHPLogger\Logger;

    // Info Log
    Logger::info('This is an info log');

    // Warning Log
    Logger::warning('This is a warning log');

    // Error Log
    Logger::error('This is an error log');

    // Dividing Line
    Logger::line('This is the dividing line');

    // Debug Log
    Logger::debug('This is a debug log');

    // Notice Log
    Logger::notice('This is a notice log');

    // Critical Log
    Logger::critical('This is a critical log');

    // None Style Log
    Logger::noneStyle('This is a none style log');

