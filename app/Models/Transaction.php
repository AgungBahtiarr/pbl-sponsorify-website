<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
     protected $fillable = ['id_user','id_sponsor','id_status','id_event'];

     public function sponsor()
     {
         return $this->belongsTo(Sponsor::class, 'id_sponsor');
     }

     public function event()
     {
         return $this->belongsTo(Event::class, 'id_event');
     }
     public function status()
     {
         return $this->belongsTo(Status::class, 'id_status');
     }
}
