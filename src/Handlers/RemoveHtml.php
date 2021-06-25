<?php

declare(strict_types=1);

namespace Inboxly\TextProcessing\Handlers;

use HTMLPurifier;
use HTMLPurifier_Config;
use Inboxly\TextProcessing\Contracts\Handler;

final class RemoveHtml implements Handler
{
    public function __construct(
        private HTMLPurifier $purifier
    ){}

    /**
     * Remove all HTML tags from text.
     *
     * @param string $text
     * @param mixed ...$arguments
     * @return string
     */
    public function handle(string $text, mixed ...$arguments): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', '');

        return $this->purifier->purify($text ?: '', $config);
    }
}
