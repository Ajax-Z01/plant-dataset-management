<?php

namespace App\Models;

use App\Models\Dataset;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Label extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'project_id'];

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }

    public function datasets()
    {
        return $this->hasMany(Dataset::class);
    }
}