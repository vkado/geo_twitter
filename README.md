# GEO and Twitter

## Getting started

Install dependencies with:

    npm install

Compress images, vectors, and javascript and less files for production with:

    grunt build

## Database

Generate Database from database folder and run sql from geo.sql


## Config

Copy config-example.php from application/config then rename to config.php and config some parameter inside config.php

    $config['base_url']	= 'http://geo.example.com/';

    $config['index_page'] = '';


Copy database-example.php from application/config then rename to database.php and config some parameter inside database.php

    $db['default']['hostname'] = 'localhost';
    $db['default']['username'] = 'root';
    $db['default']['password'] = '';
    $db['default']['database'] = 'geo';
    $db['default']['dbdriver'] = 'mysql';


Copy twitter-example.php from application/config then rename to twitter.php and config some parameter inside twitter.php

    $config['oauth_access_token']  = 'access_token';
    $config['oauth_access_token_secret'] = 'access_token_secret';
    $config['consumer_key']    = 'key';
    $config['consumer_secret']   = 'secret';


## Done

let try website. have fun !!

or try on [Demo](http://geo.weevirus.com/)