<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class DbAccess{
    public $table;
    public function __construct(string $table){
        $this->table = $table;
    }
    public function columnOf($primaryKey, string $column): ?string{
        $rc = null;
        if ( ($record = DB::table($this->table)->find($primaryKey)) !== null) {
            $rc = $record->$column();
        }
        return $rc;
    }
}