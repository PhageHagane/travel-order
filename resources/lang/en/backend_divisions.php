<?php

return [
    'table' => [
        'name'    => 'name',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New Division created',
        'updated' => 'Division updated',
        'deleted' => 'Division was deleted',
        'deleted_permanently' => 'Division was permanently deleted',
        'restored'  => 'Division was restored',
    ],

    'labels'    => [
        'management'    => 'Division Management',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'name'    => 'name',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'name' => 'name',
        ]
    ],

    'sidebar' => [
        'title'  => 'Division',
    ],

    'tabs' => [
        'name'    => 'name',
        'content'   => [
            'overview' => [
                'name'    => 'name',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'Division',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];