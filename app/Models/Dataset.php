<?php

namespace App\Models;

use App\Models\User;
use App\Models\Label;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dataset extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename',
        'label_id',
        'user_id',
        'project_id',
    ];

    public function labels()
    {
        return $this->belongsTo(Label::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }
}
