<?php

/**
 * Person Management
 * All route names are prefixed with 'admin.person'.
 */
Route::group(
    [
        'namespace' => 'Person',
        'middleware' => 'role:administrator'
    ],
    function () {
        /*
         * Person CRUD
         */
        Route::resource('person', 'PersonController');
        Route::get('job/{id}/persons', 'PersonController@job')->name(
            'person.job'
        );
    }
);
