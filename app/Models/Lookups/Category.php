<?php

namespace App\Models\Lookups;

use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'name'];

    public function opportunities(){
        return $this->belongsToMany(Opportunity::class);
    }
}
