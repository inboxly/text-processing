<?php

namespace Inboxly\TextProcessing\Tests\Handlers;

use HTMLPurifier;
use Inboxly\TextProcessing\Handlers\SanitizeHtml;
use PHPUnit\Framework\TestCase;

/**
 * @see \Inboxly\TextProcessing\Handlers\SanitizeHtml
 */
class SanitizeHtmlTest extends TestCase
{
    /**
     * @covers \Inboxly\TextProcessing\Handlers\SanitizeHtml::handle()
     * @test
     */
    public function it_remove_html_from_text()
    {
        // Setup
        $handler = new SanitizeHtml(new HTMLPurifier());
        $text = "Text with <span>html</span>.\n\nContain two paragraph and <a href='https://example.com'>link</a>";

        // Run
        $result = $handler->handle($text);

        // Asserts
        $this->assertEquals(
            "<p>Text with html.</p>\n\n<p>Contain two paragraph and "
            . "<a href=\"https://example.com\" target=\"_blank\" rel=\"noreferrer noopener\">link</a></p>",
            $result
        );
    }

    // todo: add more tests
}
