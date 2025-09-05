<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;

    protected $fillable = [
    'full_name',
    'is_old_student',
    'email',
    'mobile',
    'message',
    'is_read',
];

}
