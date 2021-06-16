<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = "role_user";

    public function userRouteRoleIdArray($user_id)
    {

        $userRoles =  $this->where('user_id', $user_id)->get("role_id");
        $plucked = $userRoles->pluck('role_id');

        return $plucked->all();
    }

}
