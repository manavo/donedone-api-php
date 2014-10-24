# DoneDone API

[![License](https://poser.pugx.org/manavo/donedone-api-php/license.svg)](https://packagist.org/packages/manavo/donedone-api-php)
[![Latest Stable Version](https://poser.pugx.org/manavo/donedone-api-php/v/stable.svg)](https://packagist.org/packages/manavo/donedone-api-php)
[![Total Downloads](https://poser.pugx.org/manavo/donedone-api-php/downloads.svg)](https://packagist.org/packages/manavo/donedone-api-php)

PHP library for connecting with [DoneDone](http://www.getdonedone.com/).

You can find DoneDone's API documentation here: http://www.getdonedone.com/api/

## Installation

Install via composer:

```
composer require manavo/donedone-api-php
```

## Usage

### Get all projects

```php
$client = new Manavo\DoneDone\Client('team_name', 'username', 'password/api_token');
$projects = $client->projects();
```

### Get all priority levels

```php
$client = new Manavo\DoneDone\Client('team_name', 'username', 'password/api_token');
$priorityLevels = $client->priorityLevels();
```

### Get all people of a project

```php
$client = new Manavo\DoneDone\Client('team_name', 'username', 'password/api_token');
$people = $client->project(1234)->people();
```

### Get all issues of a project (all, active, or closed)

```php
$client = new Manavo\DoneDone\Client('team_name', 'username', 'password/api_token');
$issues = $client->project(1234)->issues();
$activeIssues = $client->project(1234)->activeIssues();
$closedAndFixedIssues = $client->project(1234)->closedAndFixedIssues();
```

### Create a new issue
```php
$client = new Manavo\DoneDone\Client('team_name', 'username', 'password/api_token');

$project = $client->project(1111);

$issue = new \Manavo\DoneDone\Issue();
$issue->setTitle('Brand new issue!');
$issue->setPriorityLevel(1);
$issue->setFixer(4321);
$issue->setTester(1234);
$issue->addAttachment('/path/to/some/file.md'); // Optional

$addedIssue = $project->addIssue($issue);
```

### Comment on an issue

```php
$client = new Manavo\DoneDone\Client('team_name', 'username', 'password/api_token');
$issue = $client->project(29881)->issue(16);

$comment = new \Manavo\DoneDone\Comment();
$comment->setMessage('I am commenting!!!');
$comment->addAttachment('/path/to/some/file.md'); // Optional

$addedComment = $issue->addComment($comment);
```