<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Helpers\DbHelper;
use App\Helpers\Pagination;
use App\Helpers\ViewHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class WordController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('word.create');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        return view('word.edit', ['word' => $word]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return redirect('/word-index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (array_key_exists('btnSubmit', $_POST) && $_POST['btnSubmit'] == 'btnNew') {
            return redirect('/word-create');
        } else {
            $sql = 'SELECT t0.*, t1.name as username from words t0 JOIN users t1 ON t1.id=t0.verifiedby';
            $parameters = [];
            if (count($_POST) == 0) {
                $fields = [
                    'name' => '',
                    'usage' => '',
                    'wordtype' => '',
                    'verifiedby' => '',
                    'username' => '',
                    '_sortParams' => 'name:asc'
                ];
            } else {
                $fields = $_POST;
                $conditions = [];
                $parameters = [];
                ViewHelper::addConditionComparism($conditions, $parameters, '#secondary#');
                ViewHelper::addConditionPattern($conditions, $parameters, 'scope,name,shortname,value,info', 'text');
                $sql = DbHelper::addConditions($sql, $conditions);
            }
            $sql = DbHelper::addOrderBy($sql, $fields['_sortParams']);
            $records = DB::select($sql, $parameters);
            $pagination = new Pagination($sql, $parameters, $fields);
            return view('word.index', [
                'records' => $records,
                'fields' => $fields,
                'pagination' => $pagination
            ]);
        }
    }
    /**
     * Returns the validation rules.
     * @return array<string, string> The validation rules.
     */
    private function rules(): array
    {
        $rc = [
            'name' => 'required',
            'usage' => 'required',
            'wordtype' => 'required',
            'verifiedby' => 'required',
        ];
        return $rc;
    }
    public static function routes()
    {
        Route::get('/word-index', [WordController::class, 'index']);
        Route::post('/word-index', [WordController::class, 'index']);
        Route::get('/word-edit/{word}', [WordController::class, 'edit']);
        Route::post('/word-update/{word}', [WordController::class, 'update']);
        Route::get('/word-show/{word}/delete', [WordController::class, 'show']);
        Route::delete('/word-show/{word}/delete', [WordController::class, 'destroy']);
    }
    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        return view('word.show', ['word' => $word, 'mode' => 'delete']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->btnSubmit == 'btnStore') {
            $incomingFields = $request->validate($this->rules());
            $incomingFields['info'] = strip_tags($incomingFields['info']);
            Word::create($incomingFields);
        }
        return redirect('/word-index');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Word $word, Request $request)
    {
        if ($request->btnSubmit == 'btnStore') {
            $incomingFields = $request->validate($this->rules());
            $incomingFields['info'] = strip_tags($incomingFields['info']);
            $word->update($incomingFields);
        }
        return redirect('/word-index');
    }
}
