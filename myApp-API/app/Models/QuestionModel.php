<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    use HasFactory;
	
	protected $table = 'question';
	protected $primarykey = 'id';
	protected $fillable = [
		'id_bs',
		'question',
		'correct_answer'
	];
}
