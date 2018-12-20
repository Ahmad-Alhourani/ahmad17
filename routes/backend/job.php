<?php

/**
 * Job Management
 * All route names are prefixed with 'admin.job'.
 */
Route::group(
    [
        'namespace' => 'Job',
        'middleware' => 'role:administrator'
    ],
    function () {
        /*
         * Job CRUD
         */
        Route::resource('job', 'JobController');
    }
);
