<?php


namespace fize\log;

use Psr\Log\LogLevel;

/**
 * 日志类
 *
 * 遵循PSR3规范，并附加了静态方法调用
 */
class Log
{

    /**
     * @var LogHandler
     */
    protected static $loger;

    /**
     * 常规调用请先初始化
     * @param string $handler 使用的实际接口名称
     * @param array $config 配置项
     */
    public function __construct($handler, array $config = [])
    {
        self::$loger = self::getInstance($handler, $config);
    }

    /**
     * 新建实例
     * @param string $handler 使用的实际接口名称
     * @param array $config 配置项
     * @return LogHandler
     */
    public static function getInstance($handler, array $config = [])
    {
        $class = '\\' . __NAMESPACE__ . '\\handler\\' . $handler;
        return new $class($config);
    }

    /**
     * 系统无法使用
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public static function emergency($message, array $context = [])
    {
        self::log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * 必须立即采取行动
     *
     * 例如: 整个网站宕机了，数据库挂了，等等。 这应该发送短信通知警告你.
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public static function alert($message, array $context = [])
    {
        self::log(LogLevel::ALERT, $message, $context);
    }

    /**
     * 临界条件
     *
     * 例如: 应用组件不可用，意外的异常。
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public static function critical($message, array $context = [])
    {
        self::log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * 运行时错误
     *
     * 运行时错误不需要马上处理，但通常应该被记录和监控。
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public static function error($message, array $context = [])
    {
        self::log(LogLevel::ERROR, $message, $context);
    }

    /**
     * 例外事件不是错误
     *
     * 例如: 使用过时的API，API使用不当，不合理的东西不一定是错误。
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public static function warning($message, array $context = [])
    {
        self::log(LogLevel::WARNING, $message, $context);
    }

    /**
     * 正常但重要的事件
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public static function notice($message, array $context = [])
    {
        self::log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * 有趣的事件
     *
     * 例如: 用户登录，SQL日志。
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public static function info($message, array $context = [])
    {
        self::log(LogLevel::INFO, $message, $context);
    }

    /**
     * 详细的调试信息
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public static function debug($message, array $context = [])
    {
        self::log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * 可任意级别记录日志
     * @param string $level 日志级别
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public static function log($level, $message, array $context = [])
    {
        self::$loger->log($level, $message, $context);
    }
}
