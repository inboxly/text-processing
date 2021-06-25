# Text Processing package by Inboxly

Simple text processing package for internal use in Inboxly projects.

## Install

You can install the package via composer:

```bash
composer require inboxly/text-processing
```

## Usage

```php
<?php

use Illuminate\Container\Container;
use Inboxly\TextProcessing\Handlers\RemoveHtml;
use Inboxly\TextProcessing\Handlers\Trim;
use Inboxly\TextProcessing\Processor;

$container = new Container();
$processor = new Processor($container);

$text = "  \t Text has <span>html</span>, spaces, tab and newlines \n\n  ";

$result = $processor->process($text, [RemoveHtml::class, Trim::class]);

echo $result; // "Text has html, tab and newlines"

```

## Available handlers

- Trim
- Limit
- RemoveHtml
- SanitizeHtml

More handlers will be added in the near future.

## Testing

Run the tests with:

```bash
composer test
```

## License

The Inboxly is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
