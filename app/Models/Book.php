<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'tiempo_digital.tb_book';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'synopsis',
        'stars',
        'author',
        'cover_url',
        'lines_number',
        'list_id',
        ];

    use HasFactory;
}
