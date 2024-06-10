<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','email','location','proposal','start_date','end_date','id_user','end_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}


