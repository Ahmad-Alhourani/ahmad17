<?php
namespace App\Listeners\Backend;

/**
 * Class JobEventListener.
 */
/**
 * Class JobCreated.
 */
class JobEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Job Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('Job  Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('Job Deleted');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Job\JobCreated::class,
            'App\Listeners\Backend\JobEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Job\JobUpdated::class,
            'App\Listeners\Backend\JobEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Job\JobDeleted::class,
            'App\Listeners\Backend\JobEventListener@onDeleted'
        );
    }
}
