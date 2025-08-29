<?php

namespace App\Events\Backend\Permission;

use Illuminate\Queue\SerializesModels;

/**
 * Class PermissionCreated.
 */
class PermissionCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $permissions;

    /**
     * @param $permissions
     */
    public function __construct($permissions)
    {
        $this->permissions = $permissions;
    }
}
