<?php

Breadcrumbs::for('admin.offices.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_offices.labels.management'), route('admin.offices.index'));
});

Breadcrumbs::for('admin.offices.create', function ($trail) {
    $trail->parent('admin.offices.index');
    $trail->push(__('backend_offices.labels.create'), route('admin.offices.create'));
});

Breadcrumbs::for('admin.offices.show', function ($trail, $id) {
    $trail->parent('admin.offices.index');
    $trail->push(__('backend_offices.labels.view'), route('admin.offices.show', $id));
});

Breadcrumbs::for('admin.offices.edit', function ($trail, $id) {
    $trail->parent('admin.offices.index');
    $trail->push(__('backend.offices.labels.edit'), route('admin.offices.edit', $id));
});

Breadcrumbs::for('admin.offices.deleted', function ($trail) {
    $trail->parent('admin.offices.index');
    $trail->push(__('backend_offices.labels.deleted'), route('admin.offices.deleted'));
});
