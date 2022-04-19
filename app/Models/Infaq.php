<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infaq extends Model
{
    protected $fillable = [
        "project",
        "nominal",
        "status",
        "time_limit"
    ];
}
