<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_code', 'branch_id', 'project_name', 'start_date', 'expected_end_date', 'client_name', 'client_phone', 'estimated_cost', 'status'
    ];

    public function branch () {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
    public function requisitions () {
        return $this->hasMany(Requisition::class);
    }
    public function milestones () {
        return $this->hasMany(Milestone::class);
    }
    public function expenses () {
        return $this->hasMany(Expense::class);
    }
}
