<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    use HasFactory;

    protected $tables = "scans";

    protected $fillable = [
        "user_name",
        "user_email",
        "website_url",
        "type",
    ];
}
