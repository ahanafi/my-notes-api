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
     * @param $isArchived
     * @return mixed
     */
    public function scopeArchived($query, $isArchived): mixed
    {
        return $query->where('is_archived', $isArchived ? 1 : 0);
    }
}
