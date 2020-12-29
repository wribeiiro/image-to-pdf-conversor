<?php

$config['app_path']        = __DIR__ . '/app/Command';
$config['theme']           = '/Unicorn';
$config['path_upload']     = __DIR__ . '/public/';
$config['max_files']       = 10;

$config['files_to_upload'] = [
    $config['path_upload'] . 'test.jpg',
    $config['path_upload'] . 'test2.jpg',
    $config['path_upload'] . 'test3.jpeg',
    $config['path_upload'] . 'test4.jpeg',
    $config['path_upload'] . 'test5.jpg',
];

return $config;