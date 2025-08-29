<?php

Breadcrumbs::for('admin.client_types.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_client_types.labels.management'), route('admin.client_types.index'));
});

Breadcrumbs::for('admin.client_types.create', function ($trail) {
    $trail->parent('admin.client_types.index');
    $trail->push(__('backend_client_types.labels.create'), route('admin.client_types.create'));
});

Breadcrumbs::for('admin.client_types.show', function ($trail, $id) {
    $trail->parent('admin.client_types.index');
    $trail->push(__('backend_client_types.labels.view'), route('admin.client_types.show', $id));
});

Breadcrumbs::for('admin.client_types.edit', function ($trail, $id) {
    $trail->parent('admin.client_types.index');
    $trail->push(__('backend.client_types.labels.edit'), route('admin.client_types.edit', $id));
});

Breadcrumbs::for('admin.client_types.deleted', function ($trail) {
    $trail->parent('admin.client_types.index');
    $trail->push(__('backend_client_types.labels.deleted'), route('admin.client_types.deleted'));
});
