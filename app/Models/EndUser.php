<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndUser extends Model
{
  
    use HasFactory;
    protected $table = "user";
    protected $guarded = [];
    public const VALIDATION_RULES = [
        'name' => 'required',
        'email' => 'required|unique:user,email',
        'password' => 'nullable',
        'status' => 'required',
   ];

    
}
