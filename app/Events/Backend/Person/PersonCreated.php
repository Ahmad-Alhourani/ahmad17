<?php
namespace App\Events\Backend\Person;

use Illuminate\Queue\SerializesModels;
/**
 * Class PersonCreated.
 */
class PersonCreated
{
    use SerializesModels;
    /**
     * @var
     */

    public $person;

    /**
     * @param $person
     */
    public function __construct($person)
    {
        $this->person = $person;
    }
}
