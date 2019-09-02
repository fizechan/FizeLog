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
     * 构造函数
     * @param array $options,支持参数[ident、option、facility]
     */
    public function __construct(array $options = [])
    {
        openlog($options['ident'], $options['option'], $options['facility']);
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
     * @param array $options 传入的其他参数,支持参数[priority]，必传
     * @return bool
     */
    public function write($str, $type = "INF", array $options = [])
    {
        $content = "[" . $type . "]:" . $str;
        return syslog($options['priority'], $content);
    }
}
