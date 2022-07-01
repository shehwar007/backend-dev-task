<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "role_user";
    protected $guarded = [];

    public function superadmin()
    {
        return $this->belongsTo(SuperAdmin::class, 'users_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'users_id');
    }
    public function user()
    {
        return $this->belongsTo(EndUser::class, 'users_id');
    }
    public function blogger()
    {
        return $this->belongsTo(Blogger::class, 'users_id');
    }
    
}
