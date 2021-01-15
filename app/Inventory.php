<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['name', 'type', 'plate_number', 'serial_number', 'amount', 'docs1', 'docs2', 'docs3', 'docs4', 'docs5', 'docs6', 'docs7', 'docs8', 'docs9', 'docs10', 'note', 'branch_id'];

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
