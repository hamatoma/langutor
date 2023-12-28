<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Helpers\ViewHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Verb extends Model
{
    use HasFactory;
    protected $table = 'verbs';
    protected $fillable = [
        'word_id',
        'presence',
        'imperfect',
        'participle',
        'separablepart',
        'verifiedby',
    ];
}
