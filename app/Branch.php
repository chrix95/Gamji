<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'city', 'state'
    ];

    public function projects () {
        return $this->hasMany(Project::class);
    }
    public function inventory () {
        return $this->hasMany(Inventory::class);
    }
    public function expenses () {
        return $this->hasMany(Expense::class);
    }
    public function store_request () {
        return $this->hasMany(StoreRequest::class);
    }
    public function clients () {
        return $this->hasMany(Client::class);
    }
}
