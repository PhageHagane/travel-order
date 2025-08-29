<?php

Breadcrumbs::for('admin.divisions.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_divisions.labels.management'), route('admin.divisions.index'));
});

Breadcrumbs::for('admin.divisions.create', function ($trail) {
    $trail->parent('admin.divisions.index');
    $trail->push(__('backend_divisions.labels.create'), route('admin.divisions.create'));
});

Breadcrumbs::for('admin.divisions.show', function ($trail, $id) {
    $trail->parent('admin.divisions.index');
    $trail->push(__('backend_divisions.labels.view'), route('admin.divisions.show', $id));
});

Breadcrumbs::for('admin.divisions.edit', function ($trail, $id) {
    $trail->parent('admin.divisions.index');
    $trail->push(__('backend.divisions.labels.edit'), route('admin.divisions.edit', $id));
});

Breadcrumbs::for('admin.divisions.deleted', function ($trail) {
    $trail->parent('admin.divisions.index');
    $trail->push(__('backend_divisions.labels.deleted'), route('admin.divisions.deleted'));
});
