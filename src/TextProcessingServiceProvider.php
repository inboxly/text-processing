<?php

declare(strict_types=1);

namespace Inboxly\TextProcessing;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Inboxly\TextProcessing\Handlers\Limit;
use Inboxly\TextProcessing\Handlers\RemoveHtml;
use Inboxly\TextProcessing\Handlers\SanitizeHtml;
use Inboxly\TextProcessing\Handlers\Trim;

class TextProcessingServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Processing handlers to be registered
     *
     * @var string[]|\Inboxly\TextProcessing\Contracts\Handler
     */
    protected array $handlers = [
        Limit::class,
        RemoveHtml::class,
        SanitizeHtml::class,
        Trim::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Processor::class);

        foreach ($this->handlers as $handler) {
            $this->app->singleton($handler);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [Processor::class];
    }
}
