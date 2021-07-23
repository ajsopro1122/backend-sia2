<?php

namespace App\Http\Controllers;

use App\Models\Mod;
use Exception;
use Illuminate\Http\Request;

class ModController extends Controller
{
    public function show(Mod $mod) {
        return response()->json($mod,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $mods = Mod::where('brand','like',"%$request->key%")
            ->orWhere('description','like',"%$request->key%")->get();

        return response()->json($mods, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'brand' => 'string|required',
            'model' => 'string|required',
            'description' => 'string|required',
            'contained_in' => 'numeric',
            'value' => 'numeric|required',
        ]);

        try {

            $mod =  Mod::create([
                "brand" => $request->brand,
                "model"=> $request->model,
                "description"=>$request->description,
                "value"=>$request->value,
                "user_id"=>auth()->user()->id,

            ]);

            return response()->json($mod, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Mod $mod) {
        try {
            $mod->update($request->all());
            return response()->json($mod, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Mod $mod) {
        $mod->delete();
        return response()->json(['message'=>'Mod deleted.'],202);
    }

    public function index() {
        $mods = Mod::where('user_id', auth()->user()->id)->orderBy('brand')->get();
        return response()->json($mods, 200);
    }
}
