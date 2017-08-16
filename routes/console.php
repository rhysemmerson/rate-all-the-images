<?php

/*
 * Create the sqlite db files
 */
Artisan::command('app:install', function () {
    collect([
        'database.sqlite',
        'database.tests.sqlite'
    ])->each(function($file) {
        $dbpath = database_path($file);
        if (!file_exists($dbpath)) {
            printf("Creating sqlite datafile %s\n", $dbpath);
            touch($dbpath);
        }
    });
})->describe('Initialize app');
