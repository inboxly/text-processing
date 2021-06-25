<?php

namespace Inboxly\TextProcessing\Tests;

use Illuminate\Container\Container;
use Inboxly\TextProcessing\Handlers\RemoveHtml;
use Inboxly\TextProcessing\Handlers\Trim;
use Inboxly\TextProcessing\Processor;
use PHPUnit\Framework\TestCase;

class ProcessorTest extends TestCase
{
    /**
     * @covers \Inboxly\TextProcessing\Processor::process
     * @test
     */
    public function is_can_process_array_of_handlers()
    {
        // Setup
        $processor = new Processor(new Container());
        $text = ' Text with <a href="">link</a> and <span style="color: red;">styled</span> words ';

        // Run
        $result = $processor->process($text, [RemoveHtml::class, Trim::class,]);

        // Asserts
        $this->assertSame('Text with link and styled words', $result);
    }
}
