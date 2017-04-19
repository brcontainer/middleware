<?php

require 'Middleware.php';
require 'Request.php';
require 'Response.php';

$app = new Middleware;

$app->alias('request', 'Request');
$app->alias('response', 'Response');


// Create a alias for a class
//$app->alias('response', 'Foo\Bar\Baz\Minhaclass');

// In php5.4
//$app->alias('response', Foo\Bar\Baz\Minhaclassc::lass);

$app->put(function ($context) {
    echo 'Hello, world!', PHP_EOL;

    var_dump($context->request());

    return true;
});

$app->put(function ($context) {
    echo 'Good bye!', PHP_EOL;

    var_dump($context->response());
    return true;
});

$app->dispatch(function ($context) {
    echo $context->response()->body();
});
