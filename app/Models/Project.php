<?php

namespace App\Models;

use App\Models\Label;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'url_endpoint',
        'access_key',
        'secret_access_key',
    ];

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }
}
