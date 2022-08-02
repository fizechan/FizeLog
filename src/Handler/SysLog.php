<?php

namespace Fize\Log\Handler;

use Fize\Log\LogAbstract;
use Psr\Log\InvalidArgumentException;

/**
 * 系统日志
 *
 * 系统日志形式日志类
 */
class SysLog extends LogAbstract
{
    /**
     * @var array 配置
     */
    protected $config;

    /**
     * 构造函数
     * @param array $config 支持参数
     */
    public function __construct(array $config = [])
    {
        $default_config = [
            'ident'    => false,
            'option'   => LOG_CONS | LOG_NDELAY | LOG_PID,
            'facility' => LOG_USER
        ];
        $config = array_merge($default_config, $config);
        $this->config = $config;
        openlog($config['ident'], $config['option'], $config['facility']);
    }

    /**
     * 析构函数
     *
     * 关闭日志连接
     */
    public function __destruct()
    {
        closelog();
    }

    /**
     * 可任意级别记录日志
     * @param string $level   日志级别
     * @param string $message 日志内容
     * @param array  $context 占位符内容
     */
    public function log($level, $message, array $context = [])
    {
        if (!self::validLogLevel($level)) {
            throw new InvalidArgumentException();
        }

        $content = self::interpolate($message, $context);
        syslog(self::getPriority($level), $content);
    }

    /**
     * 根据日志等级返回 syslog 使用的等级常量
     * @param string $level 日志等级
     * @return int
     */
    protected static function getPriority(string $level): int
    {
        $prioritys = [
            'emergency' => LOG_EMERG,
            'alert'     => LOG_ALERT,
            'critical'  => LOG_CRIT,
            'error'     => LOG_ERR,
            'warning'   => LOG_WARNING,
            'notice'    => LOG_NOTICE,
            'info'      => LOG_INFO,
            'debug'     => LOG_DEBUG,
        ];
        return $prioritys[$level];
    }
}
