<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function creationInfo()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function scopeFilter()
    {
        
    }
}
