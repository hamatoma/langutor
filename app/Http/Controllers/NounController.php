<?php

namespace App\Http\Controllers;

use App\Models\Noun;
use App\Helpers\DbAccess;
use App\Models\SProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hamatoma\Laraknife\ViewHelpers;
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
        $options = SProperty::optionsByScope('genus', '');
        return view('noun.edit', ['noun' => $noun, 'options' => $options]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (array_key_exists('btnSubmit', $_POST) && $_POST['btnSubmit'] == 'btnNew') {
            return redirect('/noun-create');
        } else {
            $records = null;
            $join = 'join sproperties s1 ON s1.id=n.genus';
            $limit = 100;
            if (count($_POST) == 0) {
                $fields = ['genus' => '', 'text' => ''];
            } else {
                $fields = $_POST;
                $conditions = [];
                $parameters = [];
                ViewHelpers::addConditionComparism($conditions, $parameters, 'genus');
                ViewHelpers::addConditionPattern($conditions, $parameters, 'n.name,n.plural', 'text');
                if (count($conditions) > 0) {
                    $condition = count($conditions) == 1 ? $conditions[0] : implode(' AND ', $conditions);
                    $records = DB::select("select n.*,s1.name as genusstr,s1.value as article from nouns n $join where $condition order by n.name,n.id limit $limit", $parameters);
                }
            }
            if ($records === null) {
                $records = DB::select("select n.*,s1.name as genusstr, s1.value as article from nouns n $join order by n.name,n.id limit $limit");
             }
            $options = SProperty::optionsByScope('genus', $fields['genus'], '<all>');
            $sproperty = new DbAccess('sproperties');
            $value = $sproperty->columnOf(1, 'name');
            return view('noun.index', [
                'records' => $records,
                'fields' => $fields,
                'options' => $options,
                '' => $sproperty,
                'legend' => ''
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
            'name' => 'required|alpha',
            'plural' => 'required|alpha',
            'genus' => 'required',
            'usage' => 'nullable'
        ];
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
            $incomingFields = $request->validate($this->rules());
            $incomingFields['usage'] = strip_tags($incomingFields['usage']);
            Noun::create($incomingFields);
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
            $noun->update($incomingFields);
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
