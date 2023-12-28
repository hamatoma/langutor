<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Helpers\ViewHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    use HasFactory;
    protected $table = 'words';
    protected $fillable = [
        'name',
        'usage',
        'wordtype',
        'verifiedby',
    ];
}
