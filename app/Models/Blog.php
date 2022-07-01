<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = "blogs";
    protected $guarded = [];
    public const VALIDATION_RULES = [
        'title' => 'required',
        'content' => 'required',
        'status' => 'required',
     
   ];
   public function blogger_info()
   {
       return $this->belongsTo(Blogger::class, 'blogger_id');
   }
}
