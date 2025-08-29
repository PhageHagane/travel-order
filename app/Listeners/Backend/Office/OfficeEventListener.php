<?php

namespace App\Listeners\Backend\Office;

/**
 * Class OfficeEventListener.
 */
class OfficeEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->office->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->office->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->office->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Office\OfficeCreated::class,
            'App\Listeners\Backend\Office\OfficeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Office\OfficeUpdated::class,
            'App\Listeners\Backend\Office\OfficeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Office\OfficeDeleted::class,
            'App\Listeners\Backend\Office\OfficeEventListener@onDeleted'
        );
    }
}
