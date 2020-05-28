<?php

namespace App\Contracts\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void emergency($message, array $context = [], $channel = 'stack')
 * @method static void alert($message, array $context = [], $channel = 'stack')
 * @method static void critical($message, array $context = [], $channel = 'stack')
 * @method static void error($message, array $context = [], $channel = 'stack')
 * @method static void warning($message, array $context = [], $channel = 'stack')
 * @method static void notice($message, array $context = [], $channel = 'stack')
 * @method static void info($message, array $context = [], $channel = 'stack')
 * @method static void debug(strin$message, array $context = [], $channel = 'stack')
 * @method static void log($message, $level, array $context = [], $channel = 'stack')
 *
 * @see \App\Services\AppLogService
 */
class AppLog extends Facade
{
    /**
     * logging chanel database (config in logging.php)
     */
    const CHANEL_DATABASE = 'database';
    /**
     * logging chanel notification (config in logging.php)
     */
    const CHANEL_NOTIFICATION = 'notification';
    /**
     * logging chanel user (config in logging.php)
     */
    const CHANEL_USER = 'user';
    /**
     * logging chanel errorlog (config in logging.php)
     */
    const CHANEL_ERROR = 'errorlog';
    /**
     * logging chanel daily (config in logging.php)
     */
    const CHANEL_DAILY = 'daily';
    /**
     * logging chanel sessionDB (config in logging.php)
     */
    const CHANEL_SESSION_DB = 'sessionDB';
    /**
     * logging chanel loggingDB (config in logging.php)
     */
    const CHANEL_LOGGING_DB = 'loggingDB';

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'logProxy';
    }
}
