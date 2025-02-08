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
    use PHPLogger\Config\LoggerConfig;
    use PHPLogger\LoggerStyles;

    $context = new LoggerConfig(
        true,
        [
            'showLevel' => true
        ],
        null,
        null,
        [
            LoggerStyles::Info->value => ['Green', 'Default',['Blink']],
            LoggerStyles::Warning->value => ['Red', 'Default',['Bold']],
        ]
    );

    // Info Log
    Logger::info('This is an info log',null,$context);

    // Warning Log
    Logger::warning('This is a warning log',null,$context);

    // Error Log
    Logger::error('This is an error log',null,new LoggerConfig(
        true,
        null,
        null,
        null,
        [
            LoggerStyles::Error->value => ['Magenta', 'Cyan', ['Underscore','Bold']],
        ]
    ));
