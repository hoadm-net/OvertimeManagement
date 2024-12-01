<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $fillable = ['name', 'department_id', 'begin', 'end', 'description'];

    public function department() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function manager() {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function bod()
    {
        return $this->belongsTo(User::class, 'bod_id', 'id');
    }
}
