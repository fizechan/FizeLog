<?php

namespace fize\log;

/**
 * 日志工厂类
 */
class LogFactory
{
    /**
     * 新建实例
     * @param string $handler 使用的实际接口名称
     * @param array  $config  配置项
     * @return LogHandler
     */
    public static function create($handler, array $config = [])
    {
        $class = '\\' . __NAMESPACE__ . '\\handler\\' . $handler;
        return new $class($config);
    }
}
