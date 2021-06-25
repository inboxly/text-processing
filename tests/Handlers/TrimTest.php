<?php

namespace Inboxly\TextProcessing\Tests\Handlers;

use Inboxly\TextProcessing\Handlers\Trim;
use PHPUnit\Framework\TestCase;

/**
 * @see \Inboxly\TextProcessing\Handlers\Trim
 */
class TrimTest extends TestCase
{
    /**
     * @covers \Inboxly\TextProcessing\Handlers\Trim::handle()
     * @test
     */
    public function it_trim_spaces_in_text()
    {
        // Setup
        $handler = new Trim();
        $text = '  text   ';

        // Run
        $result = $handler->handle($text);

        // Asserts
        $this->assertEquals('text', $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Trim::handle()
     * @test
     */
    public function it_trim_newlines_in_text()
    {
        // Setup
        $handler = new Trim();
        $text = "\n\ntext\n\r";

        // Run
        $result = $handler->handle($text);

        // Asserts
        $this->assertEquals('text', $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Trim::handle()
     * @test
     */
    public function it_trim_tabs_in_text()
    {
        // Setup
        $handler = new Trim();
        $text = "\ttext\t\t";

        // Run
        $result = $handler->handle($text);

        // Asserts
        $this->assertEquals('text', $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Trim::handle()
     * @test
     */
    public function it_trim_all_unprintable_symbols_in_text()
    {
        // Setup
        $handler = new Trim();
        $text = " \t  \n  text \r  ";

        // Run
        $result = $handler->handle($text);

        // Asserts
        $this->assertEquals('text', $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Trim::handle()
     * @test
     */
    public function it_trim_custom_characters_in_text()
    {
        // Setup
        $handler = new Trim();
        $text = '-+_text\/=';

        // Run
        $result = $handler->handle($text, '+-_=\/');

        // Asserts
        $this->assertEquals('text', $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Trim::handle()
     * @test
     */
    public function it_trim_colon_and_comma_characters_in_text()
    {
        // Setup
        $handler = new Trim();
        $text = ':,text,:';

        // Run
        $result = $handler->handle($text, ',:');

        // Asserts
        $this->assertEquals('text', $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Trim::with()
     * @test
     */
    public function it_make_string_class_name_with_parameter()
    {
        // Run
        $result = Trim::with('+-');

        // Asserts
        $this->assertEquals('Inboxly\TextProcessing\Handlers\Trim:+-', $result);
    }

    /**
     * @covers \Inboxly\TextProcessing\Handlers\Trim::with()
     * @test
     */
    public function it_make_string_class_name_with_escaped_comma_and_colon_in_parameter()
    {
        // Run
        $result = Trim::with('+:,-');

        // Asserts
        $this->assertEquals('Inboxly\TextProcessing\Handlers\Trim:+{{colon}}{{comma}}-', $result);
    }
}
