<?php

$config['app_path']        = __DIR__ . '/app/Command';
$config['theme']           = '/Unicorn';
$config['path_upload']     = __DIR__ . '/public/';
$config['max_files']       = 10;

$config['files_to_upload'] = [
    $config['path_upload'] . 'test.jpg'
];

return $config;