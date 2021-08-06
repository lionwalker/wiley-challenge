<?php
require './vendor/autoload.php';
require './request.php';
require './HtmlElement.php';

// Time when script stats
$initTime = microtime(true);

$posts = [];

// Initiate HTML Element class
$html = new HtmlElement();

// Initiate redis client
$redis = new Predis\Client();
$cachedEntry = $redis->get('posts');

// Check if data already cached
if ($cachedEntry) {

    $html->headerThree("Displaying data from Redis cache");
    $html->lineBreak();

    // Assign cached data to posts
    $posts = json_decode($cachedEntry);

} else {

    $html->headerThree("Displaying data from REST API");
    $html->lineBreak();

    // Get data from API
    $request = new SimpleJsonRequest();
    $posts = $request::get('https://jsonplaceholder.typicode.com/posts');

    // Store data collected from API to redis cache for future use
    $redis->set('posts', json_encode($posts));
    $redis->expire('posts', 60);
}

// Output posts
$html->loopPosts($posts);
$html->lineBreak();
$html->lineBreak();

// Print total time taken to run the script in milliseconds
$endTime = microtime(true);
$html->paragraph("Script time: " . round($endTime - $initTime,4) . " (milliseconds)");
