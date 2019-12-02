<?php


namespace fize\log;

/**
 * 日志接口
 */
interface LogHandler
{

    /**
     * 构造函数
     * @param array $config 初始化默认选项
     */
    public function __construct(array $config = []);

    /**
     * 写入日志
     * @param string $str 要写入的日志主体内容
     * @param string $type 日志类型，
     * @param array $config 传入的其他参数
     * @return bool
     */
    public function write($str, $type="INF", array $config = []);
}
