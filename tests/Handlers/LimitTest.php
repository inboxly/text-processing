<?php

namespace Inboxly\TextProcessing\Tests\Handlers;

use Inboxly\TextProcessing\Handlers\Limit;
use PHPUnit\Framework\TestCase;

/**
 * @see \Inboxly\TextProcessing\Handlers\Limit
 */
class LimitTest extends TestCase
{
    /**
     * @covers \Inboxly\TextProcessing\Handlers\Limit::handle()
     * @test
     */
    public function it_limit_text_with_default_limit()
    {
        // Setup
        $handler = new Limit();
        $text =
            '123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_'.
            '123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_';

        // Run
        $result = $handler->handle($text);

        // Asserts
        $text100charactersAnd3dots =
            '123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_'.
            '...';

        $this->assertEquals($text100charactersAnd3dots, $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Limit::handle()
     * @test
     */
    public function it_limit_text_with_custom_limit_and_end()
    {
        // Setup
        $handler = new Limit();
        $text = '123456789_';

        // Run
        $result = $handler->handle($text, 5, '.');

        // Asserts
        $text10charactersAnd1dot = '12345.';

        $this->assertEquals($text10charactersAnd1dot, $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Limit::handle()
     * @test
     */
    public function it_do_not_limit_text_then_custom_limit_greater_than_text()
    {
        // Setup
        $handler = new Limit();
        $text = '123456789_';

        // Run
        $result = $handler->handle($text, 20, '...');

        // Asserts
        $this->assertEquals($text, $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Limit::with()
     * @test
     */
    public function it_make_string_class_name_with_parameters()
    {
        // Run
        $result = Limit::with(20, '...');

        // Asserts
        $this->assertEquals('Inboxly\TextProcessing\Handlers\Limit:20,...', $result);
    }
}
