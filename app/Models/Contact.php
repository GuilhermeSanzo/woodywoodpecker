<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'cell_phone',
        'email',
        'homepage',
        'facebook_profile',
        'product_info',
        'gender',
        'profession',
        'suggestion',
    ];
}
