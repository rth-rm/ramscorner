<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Reporter as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class TicketMessages extends Model
{

    use HasFactory;

protected $fillable = ['us_id','tix_id','m_content'];

protected $guarded = [];

public function reporters()
{
  return $this->belongsTo(Reporter::class);
}

}




