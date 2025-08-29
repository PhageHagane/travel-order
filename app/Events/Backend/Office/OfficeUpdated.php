<?php

namespace App\Events\Backend\Office;

use Illuminate\Queue\SerializesModels;

/**
 * Class OfficeUpdated.
 */
class OfficeUpdated
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
