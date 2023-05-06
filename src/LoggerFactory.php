<?php

namespace Fize\Log;

/**
 * 日志工厂类
 */
class LoggerFactory
{
    /**
     * 新建实例
     * @param string $handler 使用的实际接口名称
     * @param array  $config  配置项
     * @return LoggerHandler
     */
    public function create(string $handler, array $config = []): LoggerHandler
    {
        $class = '\\' . __NAMESPACE__ . '\\Handler\\' . $handler;
        return new $class($config);
    }
}
