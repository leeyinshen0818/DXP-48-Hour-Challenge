<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrategicInsight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'category',
        'read_time',
        'icon_class',
        'download_url',
        'visibility',
        'body'
    ];
}
