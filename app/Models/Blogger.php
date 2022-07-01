<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogger extends Model
{
    use HasFactory;
    protected $table = "bloggers";
    protected $guarded = [];
    public const VALIDATION_RULES = [
        'name' => 'required',
        'email' => 'required|unique:bloggers,email',
        'password' => 'nullable',
        'status' => 'required',
   ];
}
