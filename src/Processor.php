<?php
/** @noinspection PhpDocMissingThrowsInspection */
declare(strict_types=1);

namespace Inboxly\TextProcessing;


use Illuminate\Contracts\Container\Container;

final class Processor
{
    /**
     * Pipeline constructor.
     */
    public function __construct(
        private Container $container,
    ){}

    /**
     * @param string|null $value
     * @param string[] $handlers
     * @return string|null
     */
    public function process(?string $value, array $handlers): ?string
    {
        if ($value === null) {
            return null;
        }

        foreach ($handlers as $handlerClass) {
            [$handlerClass, $parameters] = $this->parseHandlerWithParameters($handlerClass);
            $handler = $this->container->make($handlerClass);
            $value = $handler->handle($value, ...$parameters);
        }

        return $value;
    }

    /**
     * @param string $handlerClass
     * @return array
     */
    private function parseHandlerWithParameters(string $handlerClass): array
    {
        [$handler, $parameters] = array_pad(explode(':', $handlerClass, 2), 2, []);

        if (is_string($parameters)) {
            $parameters = explode(',', $parameters);
        }

        return [$handler, $parameters];
    }
}
