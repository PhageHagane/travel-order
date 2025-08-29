<?php

namespace App\Events\Backend\Permission;

use Illuminate\Queue\SerializesModels;

/**
 * Class PermissionUpdated.
 */
class PermissionUpdated
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
