<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Devices extends Model
{
    use HasFactory;

    protected $primaryKey = 'd_code';

    public $incrementing = false;


    protected $keyType = 'string';
    protected $guarded = [
    ];



}
