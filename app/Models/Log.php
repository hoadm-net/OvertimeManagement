<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'overtime_approval_history';
    protected $fillable = ['overtime_id', 'user_id', 'action', 'notes'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
