<?php

namespace App\Http\Controllers;

use App\Models\Noun;
use App\Models\Word;
use App\Helpers\Pagination;
use App\Helpers\ViewHelper;
use App\Helpers\DbHelper;
use App\Models\SProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class NounController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $options = SProperty::optionsByScope('genus', '', '<Please select>');
        return view('noun.create', ['options' => $options]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noun $noun)
    {
        $options = SProperty::optionsByScope('genus', $noun->genus);
        $word = Word::find($noun->word_id);
        return view('noun.edit', ['noun' => $noun, 'word' => $word, 'options' => $options]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (array_key_exists('btnSubmit', $_POST) && $_POST['btnSubmit'] == 'btnNew') {
            return redirect('/noun-create');
        } else {
            $sql = <<<EOS
SELECT t0.*,t1.name as genusstr, t1.value as article, t2.usage, t2.name
FROM nouns t0
JOIN sproperties t1 ON t1.id=t0.genus JOIN words t2 ON t2.id=t0.word_id
EOS;
            $parameters = [];
            if (count($_POST) == 0) {
                $fields = ['genus' => '', 'text' => '', '_sortParams' => 'name:asc'];
            } else {
                $fields = $_POST;
                $conditions = [];
                ViewHelper::addConditionComparism($conditions, $parameters, 'genus');
                ViewHelper::addConditionPattern($conditions, $parameters, 't2.name,t0.plural', 'text');
                $sql = DbHelper::addConditions($sql, $conditions);
            }
            $sql = DbHelper::addOrderBy($sql, $fields['_sortParams']);
            $records = DB::select($sql, $parameters);
            $pagination = new Pagination($sql, $parameters, $fields);
            $options = SProperty::optionsByScope('genus', $fields['genus'], '<All>');
            return view('noun.index', [
                'records' => $records,
                'fields' => $fields,
                'options' => $options,
                'pagination' => $pagination
            ]);
        }
    }


    /**
     * Returns the validation rules.
     * @return array<string, string> The validation rules.
     */
    private function rules(bool $isCreate = false): array
    {
        $rc = [
            'plural' => 'required|alpha',
            'genus' => 'required',
            'usage' => 'nullable'
        ];
        if ($isCreate) {
            $rc['name'] = 'required|alpha|unique:words';
        }
        return $rc;
    }
    public static function routes()
    {
        Route::get('/noun-index', [NounController::class, 'index']);
        Route::post('/noun-index', [NounController::class, 'index']);
        Route::get('/noun-create', [NounController::class, 'create']);
        Route::post('/noun-create', [NounController::class, 'create']);
        Route::put('/noun-create', [NounController::class, 'store']);
        Route::get('/noun-edit/{noun}', [NounController::class, 'edit']);
        Route::post('/noun-update/{noun}', [NounController::class, 'update']);
        Route::get('/noun-show/{noun}/delete', [NounController::class, 'show']);
        Route::delete('/noun-show/{noun}/delete', [NounController::class, 'destroy']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->btnSubmit == 'btnStore') {
            $incomingFields = $request->validate($this->rules(true));
            $incomingFields['usage'] = strip_tags($incomingFields['usage']);
            $wordType = SProperty::byScopeAndName('wordtype', 'Noun') ?? 1011;
            $wordId = DB::table('words')->insertGetId([
                'name' => $incomingFields['name'],
                'usage' => $incomingFields['usage'],
                'wordtype' => $wordType
            ]);
            unset($incomingFields['name']);
            unset($incomingFields['usage']);
            $incomingFields['word_id'] = $wordId;
            $id = DB::table('nouns')->insertGetId($incomingFields);
        }
        return redirect('/noun-index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noun $noun)
    {
        if ($request->btnSubmit == 'btnStore') {
            $incomingFields = $request->validate($this->rules());
            $incomingFields['usage'] = strip_tags($incomingFields['usage']);
            $noun->update(['genus' => $incomingFields['genus']]);
            $word = Word::find($noun->word_id);
            $word->update(['usage' => $incomingFields['usage']]);
        }
        return redirect('/noun-index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
