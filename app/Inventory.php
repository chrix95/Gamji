<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['name', 'quantity', 'description', 'branch_id'];

    public function inventory_log () {
        return $this->hasMany(InventoryLog::class, 'inventories_id');
    }
    public function branch () {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
    public function stocks () {
        return $this->hasMany(Stock::class, 'inventory_id');
    }
}
