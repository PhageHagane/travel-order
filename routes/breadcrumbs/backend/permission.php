<?php

Breadcrumbs::for('admin.permissions.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_permissions.labels.management'), route('admin.permissions.index'));
});

Breadcrumbs::for('admin.permissions.create', function ($trail) {
    $trail->parent('admin.permissions.index');
    $trail->push(__('backend_permissions.labels.create'), route('admin.permissions.create'));
});

Breadcrumbs::for('admin.permissions.show', function ($trail, $id) {
    $trail->parent('admin.permissions.index');
    $trail->push(__('backend_permissions.labels.view'), route('admin.permissions.show', $id));
});

Breadcrumbs::for('admin.permissions.edit', function ($trail, $id) {
    $trail->parent('admin.permissions.index');
    $trail->push(__('backend.permissions.labels.edit'), route('admin.permissions.edit', $id));
});

Breadcrumbs::for('admin.permissions.deleted', function ($trail) {
    $trail->parent('admin.permissions.index');
    $trail->push(__('backend_permissions.labels.deleted'), route('admin.permissions.deleted'));
});
