<?php

namespace App\Models;

use App\Models\User;
use App\Models\Label;
use App\Models\Dataset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'bucket_name',
        'region',
        'url_endpoint',
        'access_key',
        'secret_access_key',
    ];

    public function labels()
    {
        return $this->hasMany(Label::class);
    }

    public function datasets()
    {
        return $this->hasMany(Dataset::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users');
    }
}
