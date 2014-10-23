# DoneDone API

PHP library for connecting with [DoneDone](http://www.getdonedone.com/).

## Installation

Install via composer:

```composer require manavo/donedone-api-php```

## Usage

### Get all projects

```php
$client = new Manavo\DoneDone\Client('team_name', 'username', 'password-or-api_token');
$projects = $client->projects();
```

### Get all priority levels

```php
$client = new Manavo\DoneDone\Client('team_name', 'username', 'password-or-api_token');
$priorityLevels = $client->priorityLevels();
```

### Get all people of a project

```php
$client = new Manavo\DoneDone\Client('team_name', 'username', 'password-or-api_token');
$people = $client->project(1234)->people();
```
