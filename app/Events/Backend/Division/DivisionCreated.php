<?php

namespace App\Events\Backend\Division;

use Illuminate\Queue\SerializesModels;

/**
 * Class DivisionCreated.
 */
class DivisionCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $divisions;

    /**
     * @param $divisions
     */
    public function __construct($divisions)
    {
        $this->divisions = $divisions;
    }
}
