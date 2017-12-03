# laravel-spam-protector

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

Laravel Spam Protector class to check ip, name, email for spam that uses the StopForumSpam Api https://www.stopforumspam.com/usage

## Install

Via Composer

``` bash
$ composer require johannebert/laravel-spam-protector
```


- After updating composer, add the ServiceProvider to the providers array in `config/app.php`
```php
JohannEbert\LaravelSpamProtector\SpamProtectorServiceProvider::class
```

- and for aliases
```php
'SpamProtector' => JohannEbert\LaravelSpamProtector\SpamProtectorFacade::class,
```

## Usage

``` php
$spamProtector = new SpamProtector();

if($spamProtector->isSpamEmail('john@example.com'))
{
    // If given email was registered as a spam your code goes here
}
```

## Usage Fasade

``` php
if(SpamProtector::isSpamEmail('john@example.com'))
{
    // If given email was registered as a spam your code goes here
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email johannmike.ebert@gmail.com instead of using the issue tracker.

## Credits

- [Johann-Mike Ebert][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/johannebert/laravel-spam-protector.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/JohannEbert/laravel-spam-protector/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/johannebert/laravel-spam-protector.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/johannebert/laravel-spam-protector
[link-travis]: https://travis-ci.org/JohannEbert/laravel-spam-protector
[link-downloads]: https://packagist.org/packages/johannebert/laravel-spam-protector
[link-author]: https://github.com/JohannEbert
[link-contributors]: ../../contributors
