<?php

namespace App\Events\Backend\Permission;

use Illuminate\Queue\SerializesModels;

/**
 * Class PermissionDeleted.
 */
class PermissionDeleted
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
