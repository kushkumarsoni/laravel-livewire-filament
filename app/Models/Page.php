<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopePublished(Builder $query):Void
    {
        $query->where('status',1);
    }
}
