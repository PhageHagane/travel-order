<?php

namespace App\Listeners\Backend\ClientType;

/**
 * Class ClientTypeEventListener.
 */
class ClientTypeEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->client_type->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->client_type->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->client_type->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\ClientType\ClientTypeCreated::class,
            'App\Listeners\Backend\ClientType\ClientTypeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ClientType\ClientTypeUpdated::class,
            'App\Listeners\Backend\ClientType\ClientTypeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ClientType\ClientTypeDeleted::class,
            'App\Listeners\Backend\ClientType\ClientTypeEventListener@onDeleted'
        );
    }
}
