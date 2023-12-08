<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'email',
        'last_name',
        'first_name',
        'phone_number',
    ];
}
