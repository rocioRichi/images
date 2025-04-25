<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image_route'];
}
