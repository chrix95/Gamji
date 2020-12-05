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
    public function getTotalExpensesAttribute () {
        $total = 0;
        foreach ($this->expenses as $key => $value) {
            $total += $value->amount;
        }
        return $total;
        return $this->hasMany(Expense::class);
    }
    public function getTotalMilestonesAttribute () {
        return count($this->milestones);
    }
    public function getCompletedMilestonesAttribute () {
        $total = 0;
        foreach ($this->milestones as $key => $value) {
            if ($value->status == 'completed') {
                $total += 1;
            }
        }
        return $total;
    }
    public function getOngoingMilestonesAttribute () {
        $total = 0;
        foreach ($this->milestones as $key => $value) {
            if ($value->status == 'ongoing') {
                $total += 1;
            }
        }
        return $total;
    }
    public function getPendingMilestonesAttribute () {
        $total = 0;
        foreach ($this->milestones as $key => $value) {
            if ($value->status == 'created') {
                $total += 1;
            }
        }
        return $total;
    }
    public function getPausedMilestonesAttribute () {
        $total = 0;
        foreach ($this->milestones as $key => $value) {
            if ($value->status == 'paused') {
                $total += 1;
            }
        }
        return $total;
    }
}
