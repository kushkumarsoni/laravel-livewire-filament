<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function scopePublished(Builder $query)
    {
        $query->where('status',1);
    }
}
