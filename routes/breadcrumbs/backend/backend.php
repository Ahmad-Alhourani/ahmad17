<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(
        __('strings.backend.dashboard.title'),
        route('admin.dashboard')
    );
});

//start_Person_start
Breadcrumbs::register('admin.person.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(
        __('strings.backend.persons.title'),
        route('admin.person.index')
    );
});

Breadcrumbs::register('admin.person.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.person.index');
    $breadcrumbs->push(
        __('labels.backend.persons.create'),
        route('admin.person.create')
    );
});

Breadcrumbs::register('admin.person.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.person.index');
    $breadcrumbs->push(
        __('menus.backend.persons.view'),
        route('admin.person.show', $id)
    );
});

Breadcrumbs::register('admin.person.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.person.index');
    $breadcrumbs->push(
        __('menus.backend.persons.edit'),
        route('admin.person.edit', $id)
    );
});
//end_Person_end

//start_Job_start
Breadcrumbs::register('admin.job.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(
        __('strings.backend.jobs.title'),
        route('admin.job.index')
    );
});

Breadcrumbs::register('admin.job.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.job.index');
    $breadcrumbs->push(
        __('labels.backend.jobs.create'),
        route('admin.job.create')
    );
});

Breadcrumbs::register('admin.job.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.job.index');
    $breadcrumbs->push(
        __('menus.backend.jobs.view'),
        route('admin.job.show', $id)
    );
});

Breadcrumbs::register('admin.job.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.job.index');
    $breadcrumbs->push(
        __('menus.backend.jobs.edit'),
        route('admin.job.edit', $id)
    );
});
//end_Job_end

//*****Do Not Delete Me

require __DIR__ . '/auth.php';
require __DIR__ . '/log-viewer.php';
