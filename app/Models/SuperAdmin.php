<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    use HasFactory;
    protected $table = "super_admin";
    protected $guarded = [];
    public const VALIDATION_RULES = [
        'name' => 'required',
        'email' => 'required|unique:super_admin,email',
        'password' => 'nullable',
        'status' => 'required',
   ];
}
