<?php

// admin
Breadcrumbs::for('admin.index', function ($trail) {
    $trail->push('Admin', route('admin.index'));
});

// admin > alerts
Breadcrumbs::for('admin.alert.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Alerts', route('admin.alert.index'));
});

// admin > alert > create
Breadcrumbs::for('admin.alert.create', function ($trail) {
    $trail->parent('admin.alert.index');
    $trail->push('Create', route('admin.alert.create'));
});

// admin > alert > edit
Breadcrumbs::for('admin.alert.edit', function ($trail, $alert) {
    $trail->parent('admin.alert.index');
    $trail->push('Update', route('admin.alert.edit', $alert));
});

// admin > users
Breadcrumbs::for('admin.user.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Users', route('admin.user.index'));
});

// admin > users > create
Breadcrumbs::for('admin.user.create', function ($trail) {
    $trail->parent('admin.user.index');
    $trail->push('Create', route('admin.user.create'));
});

// admin > users > edit
Breadcrumbs::for('admin.user.edit', function ($trail, $user) {
    $trail->parent('admin.user.index');
    $trail->push($user->email, route('admin.user.edit', $user));
});

// admin > prices
Breadcrumbs::for('admin.price.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Prices', route('admin.price.index'));
});

// admin > schedule
Breadcrumbs::for('admin.event.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Schedule', route('admin.event.index'));
});

// admin > schedule > create
Breadcrumbs::for('admin.event.create', function ($trail) {
    $trail->parent('admin.event.index');
    $trail->push('Create', route('admin.event.create'));
});

// admin > schedule > edit
Breadcrumbs::for('admin.event.edit', function ($trail, $event) {
    $trail->parent('admin.event.index');
    $trail->push('Edit', route('admin.event.edit', $event));
});

// admin > kids schedule
Breadcrumbs::for('admin.kids_event.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Kids schedule', route('admin.kids_event.index'));
});

// admin > kids schedule > create
Breadcrumbs::for('admin.kids_event.create', function ($trail) {
    $trail->parent('admin.kids_event.index');
    $trail->push('Create', route('admin.kids_event.create'));
});

// admin > kids schedule > edit
Breadcrumbs::for('admin.kids_event.edit', function ($trail, $event) {
    $trail->parent('admin.kids_event.index');
    $trail->push('Edit', route('admin.kids_event.edit', $event));
});


// admin > texts
Breadcrumbs::for('admin.text.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Texts', route('admin.text.index'));
});

// admin > texts > {route} > edit
Breadcrumbs::for('admin.text.edit', function ($trail, $text) {
    $trail->parent('admin.text.index');
    $trail->push($text->route);
    $trail->push($text->name, route('admin.text.edit', $text));
});
