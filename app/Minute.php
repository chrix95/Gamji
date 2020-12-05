<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minute extends Model
{
    protected $fillable = ['title', 'content', 'file_url', 'remark', 'branch_id'];

    public function branch () {
        return $this->belongsTo(Branch::class);
    }
}
