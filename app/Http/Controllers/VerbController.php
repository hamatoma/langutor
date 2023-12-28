<?php

namespace App\Http\Controllers;

use App\Models\Verb;
use App\Models\Word;
use App\Helpers\ViewHelper;
use App\Helpers\DbHelper;
use App\Helpers\Pagination;
use App\Rules\WordListLowercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class VerbController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('verb.create');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Verb $verb)
    {
        $word = Word::find($verb->word_id);
        return view('verb.edit', ['verb' => $verb, 'word' => $word]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Verb $verb)
    {
        $verb->delete();
        return redirect('/verb-index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (array_key_exists('btnSubmit', $_POST) && $_POST['btnSubmit'] == 'btnNew') {
            return redirect('/verb-create');
        } else {
            $sql = 'SELECT t0.*, t1.usage, t1.name FROM verbs t0 '
                . 'JOIN words t1 ON t1.id=t0.word_id';
            $parameters = [];
            if (count($_POST) == 0) {
                $fields = ['text' => '', '_sortParams' => 'name:asc'];
            } else {
                $fields = $_POST;
                $conditions = [];
                ViewHelper::addConditionPattern($conditions, $parameters, 't1.name,presence,imperfect,participle', 'text');
                $sql = DbHelper::addConditions($sql, $conditions);
            }
            $sql = DbHelper::addOrderBy($sql, $fields['_sortParams']);
            $records = DB::select($sql, $parameters);
            $pagination = new Pagination($sql, $parameters, $fields);
            return view('verb.index', [
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
            'presence' => new WordListLowercase,
            'imperfect' => new WordListLowercase,
            'participle' => 'alpha',
            'separablepart' => 'alpha',
            'usage' => 'required',
        ];
        return $rc;
    }
    public static function routes()
    {
        Route::get('/verb-index', [VerbController::class, 'index']);
        Route::post('/verb-index', [VerbController::class, 'index']);
        Route::get('/verb-create', [VerbController::class, 'create']);
        Route::post('/verb-create', [VerbController::class, 'create']);
        Route::put('/verb-create', [VerbController::class, 'store']);
        Route::get('/verb-edit/{verb}', [VerbController::class, 'edit']);
        Route::post('/verb-update/{verb}', [VerbController::class, 'update']);
        Route::get('/verb-show/{verb}/delete', [VerbController::class, 'show']);
        Route::delete('/verb-show/{verb}/delete', [VerbController::class, 'destroy']);
    }
    /**
     * Display the specified resource.
     */
    public function show(Verb $verb)
    {
        return view('verb.show', ['verb' => $verb, 'mode' => 'delete']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->btnSubmit == 'btnStore') {
            $incomingFields = $request->validate($this->rules());
            $incomingFields['info'] = strip_tags($incomingFields['info']);
            Verb::create($incomingFields);
        }
        return redirect('/verb-index');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Verb $verb, Request $request)
    {
        if ($request->btnSubmit == 'btnStore') {
            $incomingFields = $request->validate($this->rules());
            $incomingFields['info'] = strip_tags($incomingFields['info']);
            $verb->update($incomingFields);
        }
        return redirect('/verb-index');
    }
}
