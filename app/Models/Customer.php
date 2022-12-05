<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Customer extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class,'assigned_employee_id');
    }
}
