<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['project_id', 'amount', 'remark'];

    public function project () {
        return $this->belonsTo(Project::class);
    }
}
