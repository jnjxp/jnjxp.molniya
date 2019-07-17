# jnjxp.molniya
Middleware to make [Zend\Expressive\Flash] messages available in [Zend\Expressive\Template]

[![Latest version][ico-version]][link-packagist]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]

## Installation
```
composer require jnjxp/molniya
```

## Usage
Add `Jnjxp\Molniya\MessageMiddleware` to your pipeline after the session and
flash middleware.

Output `$messages` in your view script. e.g. `<?= $messages ?? ''; ?>`



[Zend\Expressive\Flash]: https://github.com/zendframework/zend-expressive-flash
[Zend\Expressive\Template]: https://github.com/zendframework/zend-expressive-template

[ico-version]: https://img.shields.io/packagist/v/jnjxp/molniya.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/jnjxp/jnjxp.molniya/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/jnjxp/jnjxp.molniya.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/jnjxp/jnjxp.molniya.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jnjxp/molniya
[link-travis]: https://travis-ci.org/jnjxp/jnjxp.molniya
[link-scrutinizer]: https://scrutinizer-ci.com/g/jnjxp/jnjxp.molniya
[link-code-quality]: https://scrutinizer-ci.com/g/jnjxp/jnjxp.molniya
