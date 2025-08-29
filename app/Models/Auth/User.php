<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use App\Models\Auth\Traits\Scope\UserScope;

/**
 * Class User.
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;

    public function office()
    {
        return $this->belongsTo('App\Models\Office', 'office_id');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division', 'division_id');
    }

    public function clientType()
    {
        return $this->belongsTo('App\Models\ClientType', 'client_type_id');
    }
}