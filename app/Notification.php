<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'content', 'branch_id', 'expected_date', 'status'];

    public function branch () {
        return $this->belongsTo(Branch::class);
    }
}
