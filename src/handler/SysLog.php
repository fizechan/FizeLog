<?php

namespace fize\log\handler;

use fize\log\LogHandler;

/**
 * 系统形式日志类
 * @package fize\log\handler
 */
class SysLog implements LogHandler
{
    /**
     * @var array 配置
     */
    protected $config;

    /**
     * 构造函数
     * @param array $config 支持参数[ident、option、facility]
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
     * 关闭日志连接
     */
    public function __destruct()
    {
        closelog();
    }

    /**
     * 写入日志
     * @param string $str 要写入的日志主体内容
     * @param string $type 日志类型，
     * @param array $config 传入的其他参数,支持参数[priority]
     * @return bool
     */
    public function write($str, $type = "INF", array $config = [])
    {
        $config['priority'] = isset($config['priority']) ? $config['priority'] : LOG_INFO;
        $config = array_merge($this->config, $config);
        $content = "[" . $type . "]:" . $str;
        return syslog($config['priority'], $content);
    }
}
