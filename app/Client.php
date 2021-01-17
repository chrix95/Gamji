<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'branch_id'];

    public function documents() {
        return $this->hasMany(ClientDocument::class);
    }
    public function branch () {
        return $this->belongsTo(Branch::class);
    }
}
