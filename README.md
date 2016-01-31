# jnjxp.molniya
Session handler middleware with a simple flash messenger wrapped around
[Aura\Session]

[![Latest version][ico-version]][link-packagist]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]

## Installation
```
composer require jnjxp/molniya
```

## Usage
```php
use Jnjxp\Molniya\FlashMessengerFactory;

// Can create an instance like this,
// but probably want to use the Session handler
$factory = new FlashMessengerFactory();
$messenger = $factory->newInstance();

// Add a message (default level: "info")
$messenger->add('Some notice');

// Add a message with a status level
$messenger->add('Some warning', 'warning');

// Replace all messages of given level
$messenger->set(
    [
        'Somthing went wrong',
        'You should try again'
    ],
    'warning'
);

// Replace all messages of all levels
$messenger->setAll(
    [
        'info' => 'Somthing happened',
        'warning' => ['You should be concerned'],
        'success' => 'Some thing went well',
        'danger' => [
            'Something went wrong',
            'Very wrong'
        ]
    ]
);

// Get messages for a level
$messages = $messenger->get('warning');

// Get next requests messages for level
$nextMessages = $messages->getNext('danger');

// Get all messages
$messages = $messenger->getAll();

// Get all messages for next request
$messages = $messenger->getNextAll();

// Check for messages of a certain level
if ($messenger->has('warning')) {
    // do something
}

// Check for any messages
if ($messenger->hasAny()) {
    // do something
}

// Check for messages of a certain level on next request
if ($messenger->nextHas('warning')) {
    // do something
}

// Check for any messages in next request
if ($messenger->nextHasAny()) {
    // do something
}

// Clear messages for a level
$messenger->clear('warning');

// Clear all messages
$messenger->clearAll();

// use __call to set levels
$messenger->warning('This is a warning');

// keep current messages for next request
$messenger->keep();

```

### Session Handler
```php
// Create new handler
use Jnjxp\Molniya\SessionHandler;

$handler = new SessionHandler();
// can also inject factories for Session and Messenger
// $handler = new SessionHandler(
//    new SessionFactory(),
//    new FlashMessengerFactory()
// );

// optionally set attributes
$handler->setSessionAttribute('session'); // default: aura/session:session
$handler->setMessengerAttribute('messenger'); // default: jnjxp/molniya:messenger

// optionally set mesenger namespace
$handler->setMessengerNamespace('something'); // default: Jnjxp\Molniya

// ...
// after request has passed SessionHandler middleware
// $handler($request, $response, $next);

$session = $request->getAttribute('session');
$messenger = $request->getAttribute('messenger');


```


[Aura\Session]: https://github.com/auraphp/Aura.Session

[ico-version]: https://img.shields.io/packagist/v/jnjxp/molniya.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/jnjxp/jnjxp.molniya/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/jnjxp/jnjxp.molniya.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/jnjxp/jnjxp.molniya.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jnjxp/molniya
[link-travis]: https://travis-ci.org/jnjxp/jnjxp.molniya
[link-scrutinizer]: https://scrutinizer-ci.com/g/jnjxp/jnjxp.molniya
[link-code-quality]: https://scrutinizer-ci.com/g/jnjxp/jnjxp.molniya
