# Laravel Sessions
![Packagist](https://img.shields.io/packagist/l/ryancco/laravel-sessions?style=flat-square)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/ryancco/laravel-sessions/tests?style=flat-square)
![Packagist](https://img.shields.io/packagist/dm/ryancco/laravel-sessions?style=flat-square)

The missing model for Laravel sessions with some conveniently opinionated functionality built-in.

## Installation
Laravel Sessions can be installed via Composer.
```bash
composer require ryancco/laravel-sessions
```

## Usage

### Apply the HasSessions trait to your User model
```php
class User extends Authenticatable
{
    use \Ryancco\Sessions\HasSessions;

```

### Get a user's active sessions
`@method active(Carbon|int $last_activity = 60)`
```php
$user->sessions()
    ->active(30) // active in the last 30 minutes
    ->get();
```

### Get a user's inactive sessions
`@method inactive(Carbon|int $last_activity = 60)`
```php
$user->sessions()->inactive(
    now()->subHours(2) // not active in the last 2 hours
)->get();
```

### Get a session's device
Currently, this package leverages [jenssegers/agent](https://github.com/jenssegers/agent) for device information. Check out the pieces used and head over to that repository for any further information.

```php
$device = $user->sessions()
    ->latest('last_activity')
    ->first()
    ->device();

$device->device();
$device->browser();
$device->platform();
$device->browserVersion();
$device->platformVersion();
```

## Preqrequisites
Laravel Sessions expects you to be using Laravel's database session driver. To learn more about this and other session driver preqrequisites, check out the [documentation](https://laravel.com/docs/master/session#driver-prerequisites).

## Contributing
Please report any problems by creating an [issue](https://github.com/ryancco/laravel-sessions/issues). Pull requests are always welcomed.