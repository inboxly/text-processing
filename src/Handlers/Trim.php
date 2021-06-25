<?php

declare(strict_types=1);

namespace Inboxly\TextProcessing\Handlers;

use Inboxly\TextProcessing\Contracts\Handler;

final class Trim implements Handler
{
    /**
     * Make Trim class string with parameters.
     *
     * @param string $characters
     * @return string
     */
    public static function with(string $characters = " \t\n\r\0\x0B"): string
    {
        // Escape colon and comma symbols because is reserved as separators at parsing parameters in Processor
        $characters = str_replace([':', ','], ["{{colon}}", "{{comma}}"], $characters);

        return self::class . ":$characters";
    }

    /**
     * Strip whitespace (or other characters) from the beginning and end of the text.
     *
     * @param string $text
     * @param mixed ...$arguments
     * @return string
     */
    public function handle(string $text, mixed ...$arguments): string
    {
        if (isset($arguments[0])) {
            // Revert escaped colon and comma symbols
            $arguments[0] = str_replace(["{{colon}}", "{{comma}}"], [':', ','], $arguments[0]);
        }

        return trim($text, ...$arguments);
    }
}
