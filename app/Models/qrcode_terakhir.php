<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qrcode_terakhir extends Model
{
    use HasFactory;
    protected $table = "qrcode_terakhir";
    protected $guarded = [];
    protected $primaryKey   = 'id';
}
