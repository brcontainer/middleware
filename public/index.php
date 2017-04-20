<?php
require '../src/Middleware.php';
require '../src/Http/Request.php';
require '../src/Http/Response.php';
# require '../src/Cache.php';

$app = new Middleware;

$app->alias('request', 'Http\Request');
$app->alias('response', 'Http\Response');

// $app->alias('cache', 'Cache');

// Create a alias for a class
//$app->alias('example1', 'Foo\Bar\Baz\Myclass');

// In PHP 5.4
//$app->alias('example2', Foo\Bar\Baz\Myclass::class);

$app->queue(function ($context) {
    $context->response()->body('Hello, world!');

    return true;
});

$app->dispatch(function ($context) {
    echo $context->response()->body();
});
