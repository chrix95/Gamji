<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'project_id', 'name', 'description', 'start_date', 'expected_end_date', 'status'
    ];

    public function project () {
        return $this->belongsTo(Project::class);
    }
}
