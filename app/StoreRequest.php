<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreRequest extends Model
{
    //
    protected $fillable = ['user_id', 'branch_id', 'approval_date', 'request_form', 'machines', 'approved_request_form', 'approved_by', 'reject_reason', 'status', 'note'];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function branch () {
        // return $this->belongsTo(Branch::class, 'id', 'branch_id');
        return $this->belongsTo(Branch::class);
    }

    public function setMachinesAttribute($value) {
        $this->attributes['machines'] = json_encode($value);
    }
   
    public function getMachinesAttribute($value)
    {
        return json_decode($value);
    }
}
