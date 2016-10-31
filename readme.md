# Tweet Search

Build in laravel 5.3

Tweet Search is web application that allows the user to search for a city and displays tweets that mention the city on a map.

## Setup

* run `composer intsall`
* copy .env.example contents to .env
* run `php artisan key:generate`
* Fill this required env keys

```
// twitter api
TWITTER_CONSUMER_KEY=
TWITTER_CONSUMER_SECRET=
TWITTER_ACCESS_TOKEN=
TWITTER_ACCESS_TOKEN_SECRET=

// Google map api key
GMAP_API_KEY=
```


## Search result config

File: config/search.php

1. Cache settings `lifetime => 3600`
2. Limit number of search results `count => 20`
3. Default Search range `default_range => '50km'`
