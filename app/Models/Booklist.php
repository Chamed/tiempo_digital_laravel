<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booklist extends Model
{
    protected $table = 'tiempo_digital.tb_list';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'parent_id',
        'owner_id',
        'is_system_default',
        'color',
        'description',
        ];

    use HasFactory;
}
