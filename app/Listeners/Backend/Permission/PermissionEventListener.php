<?php

namespace App\Listeners\Backend\Permission;

/**
 * Class PermissionEventListener.
 */
class PermissionEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->permission->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->permission->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->permission->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Permission\PermissionCreated::class,
            'App\Listeners\Backend\Permission\PermissionEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Permission\PermissionUpdated::class,
            'App\Listeners\Backend\Permission\PermissionEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Permission\PermissionDeleted::class,
            'App\Listeners\Backend\Permission\PermissionEventListener@onDeleted'
        );
    }
}
