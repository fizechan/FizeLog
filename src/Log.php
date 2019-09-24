<?php


namespace fize\log;

/**
 * 日志类
 * @package fize\log
 */
class Log
{

    /**
     * @var LogHandler
     */
    private static $handler;

    /**
     * 禁止构造
     */
    private function __construct()
    {
    }

    /**
     * 取得单例
     * @param string $driver 使用的实际接口名称
     * @param array $options 配置项
     * @return LogHandler
     */
    public static function getInstance($driver, array $options = [])
    {
        if (empty(self::$handler)) {
            self::$handler = self::getNew($driver, $options);
        }
        return self::$handler;
    }

    /**
     * 新建实例
     * @param string $driver 使用的实际接口名称
     * @param array $options 配置项
     * @return LogHandler
     */
    public static function getNew($driver, array $options = [])
    {
        $class = '\\' . __NAMESPACE__ . '\\handler\\' . $driver;
        return new $class($options);
    }
}
