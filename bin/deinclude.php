<?php

$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../src'));
/* @var $file SplFileInfo */
foreach ($files as $file) {
    if (!$file->isFile()
        || 'php' != $file->getExtension()
    ) {
        continue;
    }
    echo $file->getRealPath() . PHP_EOL;
    $code = file_get_contents($file->getRealPath());
    $code = preg_replace("~require_once '[a-zA-Z0-9\/]+\.php';~", '//\\0', $code);
    $code = preg_replace('~require_once "[a-zA-Z0-9\/]+\.php";~', '//\\0', $code);
    $code = preg_replace("~require_once\('[a-zA-Z0-9\/]+\.php'\);~", '//\\0', $code);
    $code = preg_replace('~require_once\("[a-zA-Z0-9\/]+\.php"\);~', '//\\0', $code);
    $code = preg_replace("~include_once '[a-zA-Z0-9\/]+\.php';~", '//\\0', $code);
    $code = preg_replace('~include_once "[a-zA-Z0-9\/]+\.php";~', '//\\0', $code);
    $code = preg_replace("~include_once\('[a-zA-Z0-9\/]+\.php'\);~", '//\\0', $code);
    $code = preg_replace('~include_once\("[a-zA-Z0-9\/]+\.php"\);~', '//\\0', $code);
    file_put_contents($file->getRealPath(), $code);
}
