<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'docs'
    ];

    public function project () {
        return $this->belongsTo(Project::class);
    }
}
