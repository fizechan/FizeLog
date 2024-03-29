<?php

namespace Fize\Log;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use ReflectionClass;

/**
 * 日志抽象类
 *
 * 提供了实际实现类需要的方法
 */
abstract class LoggerAbstract extends AbstractLogger implements LoggerHandler
{

    /**
     * 判断日志等级是否合法
     * @param string $level 日志等级标识
     * @return bool
     */
    protected static function validLogLevel(string $level): bool
    {
        $class = new ReflectionClass(LogLevel::class);
        $found = false;
        $constants = $class->getReflectionConstants();
        foreach ($constants as $constant) {
            if ($constant->getValue() == $level) {
                $found = true;
                break;
            }
        }
        return $found;
    }

    /**
     * 对日志主体进行占位符替换
     * @param string $message 待替换的原日志主体
     * @param array  $context 占位符实际内容
     * @return string
     */
    protected static function interpolate(string $message, array $context = []): string
    {
        $replace = [];
        foreach ($context as $key => $val) {
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }
        return strtr($message, $replace);
    }
}
