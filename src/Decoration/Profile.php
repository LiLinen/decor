<?php

declare(strict_types=1);

namespace LiLinen\Decor\Decoration;

use Doctrine\Common\Annotations\Annotation\Enum;
use Psr\Log\LogLevel;

/**
 * @Annotation
 * @Target("METHOD")
 *
 * @see \LiLinen\Decor\Decorator\ProfileDecorator
 */
final class Profile extends AbstractDecoration
{
    private const DEFAULT_MESSAGE = '[Profiling]';

    /**
     * @Enum({
     *     \Psr\Log\LogLevel::DEBUG,
     *     \Psr\Log\LogLevel::INFO,
     *     \Psr\Log\LogLevel::NOTICE,
     *     \Psr\Log\LogLevel::WARNING,
     *     \Psr\Log\LogLevel::ERROR,
     *     \Psr\Log\LogLevel::CRITICAL,
     *     \Psr\Log\LogLevel::ALERT,
     *     \Psr\Log\LogLevel::EMERGENCY,
     * })
     *
     * @var string
     */
    private $level = LogLevel::DEBUG;

    /**
     * @var string
     */
    private $message = self::DEFAULT_MESSAGE;

    /**
     * @var bool
     */
    private $includeMetadata = true;

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return bool
     */
    public function getIncludeMetadata(): bool
    {
        return $this->includeMetadata;
    }

    /**
     * @param bool $includeMetadata
     */
    public function setIncludeMetadata(bool $includeMetadata): void
    {
        $this->includeMetadata = $includeMetadata;
    }
}
