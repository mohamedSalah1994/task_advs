<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function advs()
    {
        return $this->hasMany(Adv::class);

    }
}
