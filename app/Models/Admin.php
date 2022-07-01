<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = "admin";
    protected $guarded = [];
    public const VALIDATION_RULES = [
        'name' => 'required',
        'email' => 'required|unique:admin,email',
        'password' => 'nullable',
        'status' => 'required',
   ];
}
