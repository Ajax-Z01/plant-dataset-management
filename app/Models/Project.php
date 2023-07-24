<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'label',
        'collaborator',
        'url',
        'accesskey',
        'secretaccesskey',
        // 'user_id'
    ];
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
