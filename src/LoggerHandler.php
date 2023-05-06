<?php

namespace Fize\Log;

use Psr\Log\LoggerInterface;

/**
 * 日志接口
 */
interface LoggerHandler extends LoggerInterface
{

    /**
     * 构造函数
     * @param array $config 初始化默认选项
     */
    public function __construct(array $config = []);
}
