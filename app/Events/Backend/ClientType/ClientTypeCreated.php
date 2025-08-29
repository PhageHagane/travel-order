<?php

namespace App\Events\Backend\ClientType;

use Illuminate\Queue\SerializesModels;

/**
 * Class ClientTypeCreated.
 */
class ClientTypeCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $client_types;

    /**
     * @param $client_types
     */
    public function __construct($client_types)
    {
        $this->client_types = $client_types;
    }
}
