<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'email', 'location', 'proposal', 'image', 'start_date', 'id_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


    public function benefitLevel()
    {
        return $this->hasMany(BenefitLevel::class);
    }
}
