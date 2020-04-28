<?php

namespace fize\log;

use Psr\Log\LoggerInterface;

/**
 * 日志接口
 */
interface LogHandler extends LoggerInterface
{

    /**
     * 构造函数
     * @param array $config 初始化默认选项
     */
    public function __construct(array $config = []);
}
