<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['name', 'quantity', 'description', 'branch_id'];

    public function inventory_log () {
        return $this->hasMany(InventoryLog::class);
    }
    public function branch () {
        return $this->hasOne(Branch::class);
    }
    public function stocks () {
        return $this->hasMany(Stock::class);
    }
}
