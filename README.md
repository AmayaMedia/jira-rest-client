# A Simple API for interacting with JIRA

[![Latest Version on Packagist](https://img.shields.io/packagist/v/amayamedia/jira-rest-client.svg?style=flat-square)](https://packagist.org/packages/amayamedia/jira-rest-client)
[![Total Downloads](https://img.shields.io/packagist/dt/amayamedia/jira-rest-client.svg?style=flat-square)](https://packagist.org/packages/amayamedia/jira-rest-client)
![GitHub Actions](https://github.com/amayamedia/jira-rest-client/actions/workflows/main.yml/badge.svg)

A high-level client for interacting with JIRA Server Rest API. Currently only supports Worklogs

## Installation

You can install the package via composer:

```bash
composer require amayamedia/jira-rest-client
```

## Usage

```php
$authClient = new AuthService('https://example.com/api/auth');
$issueService = new IssueService();
$issueService->useAuth($authClient);

// Get Worklogs for an issue
$issue = $issueService->getWorklog('TEST-1');

// Add a Worklog to an Issue
$issueService->addWorklog('TEST-1', [
    'comment' => 'I did some work',
    'timeSpentSeconds' => 12000
]);
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email rene@amayamedia.com instead of using the issue tracker.

## Credits

-   [Rene Merino](https://github.com/amayamedia)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
