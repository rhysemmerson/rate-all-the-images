<?php

/*
 * Create the sqlite file
 */
Artisan::command('app:install', function () {
    $dbpath = database_path('database.sqlite');
    if (!file_exists($dbpath)) {
        printf("Creating sqlite datafile %s\n", $dbpath);
        touch($dbpath);
    }
})->describe('Initialize app');
