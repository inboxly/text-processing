<?php

declare(strict_types=1);

namespace Inboxly\TextProcessing\Handlers;

use Illuminate\Support\Str;
use Inboxly\TextProcessing\Contracts\Handler;

final class Limit implements Handler
{
    /**
     * Make Limit class string with parameters.
     *
     * @param int $limit
     * @param string $end
     * @return string
     */
    public static function with(int $limit = 100, string $end = '...'): string
    {
        return self::class . ":$limit,$end";
    }

    /**
     * Limit the number of characters in the text.
     *
     * @param string $text
     * @param mixed ...$arguments
     * @return string
     */
    public function handle(string $text, mixed ...$arguments): string
    {
        return Str::limit($text, ...$arguments);
    }
}
