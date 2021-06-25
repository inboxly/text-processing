<?php

namespace Inboxly\TextProcessing\Tests\Handlers;

use HTMLPurifier;
use Inboxly\TextProcessing\Handlers\RemoveHtml;
use PHPUnit\Framework\TestCase;

/**
 * @see \Inboxly\TextProcessing\Handlers\RemoveHtml
 */
class RemoveHtmlTest extends TestCase
{
    /**
     * @covers \Inboxly\TextProcessing\Handlers\RemoveHtml::handle()
     * @test
     */
    public function it_remove_html_from_text()
    {
        // Setup
        $handler = new RemoveHtml(new HTMLPurifier());
        $text = 'Text <span>with</span> html';

        // Run
        $result = $handler->handle($text);

        // Asserts
        $this->assertEquals('Text with html', $result);
    }

    // todo: add more tests
}
