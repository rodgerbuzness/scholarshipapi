<?php

namespace App\Models;

use App\Models\Lookups\Category;
use App\Models\Lookups\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'country_id',
        'deadline',
        'organizer',
        'created_by'
    ];

    protected $casts = [
        'deadline' => 'datetime'
    ];

    public function detail(){
        return $this->hasOne(OpportunityDetail::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
