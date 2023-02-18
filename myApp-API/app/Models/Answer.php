<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    use HasFactory;

    protected $table = 'answer';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_qst',
        'pg',
        'answered'
    ];
}
