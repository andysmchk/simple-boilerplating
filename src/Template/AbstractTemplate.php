<?php
declare(strict_types=1);

namespace Rewsam\SimpleBoilerplating\Template;

/**
 * @codeCoverageIgnore
 */
abstract class AbstractTemplate implements Template
{
    public function __construct(
        protected string $destination,
        protected string $content
    ) {}
}
