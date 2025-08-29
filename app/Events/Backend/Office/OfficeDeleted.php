<?php

namespace App\Events\Backend\Office;

use Illuminate\Queue\SerializesModels;

/**
 * Class OfficeDeleted.
 */
class OfficeDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $offices;

    /**
     * @param $offices
     */
    public function __construct($offices)
    {
        $this->offices = $offices;
    }
}
