<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

     protected $fillable = ['name','email','description','address','id_category','max_submission_date','image','id_user'];


     public function category()
     {
         return $this->belongsTo(Category::class, 'id_category');
     }
}
