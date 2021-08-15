<?php

declare(strict_types=1);

namespace Inboxly\TextProcessing\Handlers;

use HTMLPurifier;
use HTMLPurifier_Config;
use Inboxly\TextProcessing\Contracts\Handler;

final class SanitizeHtml implements Handler
{
    public function __construct(
        private HTMLPurifier $purifier
    ){}

    /**
     * Remove not safe HTML tags from text
     *
     * @param string $text
     * @param mixed ...$arguments
     * @return string
     */
    public function handle(string $text, mixed ...$arguments): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('AutoFormat.AutoParagraph', true);
        $config->set('AutoFormat.Linkify', true);
        $config->set('AutoFormat.RemoveEmpty', true);
        $config->set('AutoFormat.RemoveEmpty.Predicate', ['iframe' => ['src']]);
        $config->set('CSS.AllowedProperties', []);
        $config->set('Filter.YouTube', true);
        $config->set('HTML.Allowed', 'p,b,a[href],img[src],i');
        $config->set('HTML.SafeIframe', true);
        $config->set('HTML.TargetBlank', true);
        $config->set(
            'URI.SafeIframeRegexp',
            '%^(https?:)?(\/\/www\.youtube(?:-nocookie)?\.com\/embed\/|\/\/player\.vimeo\.com\/)%'
        );

        return $this->purifier->purify($text, $config);
    }
}
