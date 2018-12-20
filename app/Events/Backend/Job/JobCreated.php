<?php
namespace App\Events\Backend\Job;

use Illuminate\Queue\SerializesModels;
/**
 * Class JobCreated.
 */
class JobCreated
{
    use SerializesModels;
    /**
     * @var
     */

    public $job;

    /**
     * @param $job
     */
    public function __construct($job)
    {
        $this->job = $job;
    }
}
