<?php

namespace App\Listeners\Backend\Division;

/**
 * Class DivisionEventListener.
 */
class DivisionEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->division->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->division->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->division->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Division\DivisionCreated::class,
            'App\Listeners\Backend\Division\DivisionEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Division\DivisionUpdated::class,
            'App\Listeners\Backend\Division\DivisionEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Division\DivisionDeleted::class,
            'App\Listeners\Backend\Division\DivisionEventListener@onDeleted'
        );
    }
}
