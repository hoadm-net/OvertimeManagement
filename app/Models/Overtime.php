<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $fillable = [
        'name',
        'email',
        'department_id',
        'begin',
        'end',
        'description',
        'status',
        'bus',
        'shift',
        'current_manager'
    ];

    public function department() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function manager() {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function logs() {
        return $this->hasMany(Log::class, 'overtime_id', 'id');
    }

    public function lastLog() {
        return $this->hasOne(Log::class, 'overtime_id', 'id')->latest('created_at');
    }

}
