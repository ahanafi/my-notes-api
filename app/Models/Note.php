<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'body', 'is_archived'
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeArchived($query): mixed
    {
        return $query->where('is_archived', 1);
    }
}
