<?php

declare(strict_types=1);

namespace Inboxly\TextProcessing\Contracts;

interface Handler
{
    /**
     * Handle text.
     *
     * @param string $text
     * @param mixed ...$arguments
     * @return string
     */
    public function handle(string $text, mixed ...$arguments): string;
}
