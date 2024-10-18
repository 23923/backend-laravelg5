<?php

namespace App\Http\Controllers;

use App\Models\Scategorie;
use Illuminate\Http\Request;

class ScategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    try{
        $scategories=Scategorie::with("categorie")->get();
        return response()->json($scategories);}
        catch(\Exception $e){return response()->json($e->getMessage());
            //throw $th
    }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $scategorie=new Scategorie([
                "nomcategorie"=>$request->input("nomcategorie"),
                "imagescategorie"=>$request->input("imagescategorie"),
                "categorie_id"=>$request->input("categorie_id"),
            ]);
            return response() -> json("mrgl");

        }catch(\Exception $e){return response()->json($e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $scategorie=Scategorie::with("categorie")->findOrFail($id);
            return response() ->json($scategorie);

        }
        catch(\Exception $e){return response()->json($e->getMessage());

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $scategorie=Scategorie::findOrfail($id);
            $scategorie->update($request->all());
            return response()->json($scategorie);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $scategorie=Scategorie::findOrfail($id);
            $scategorie->delete();
            return response()->json("Scatégorie supprimée avec succées");
           } catch (\Exception $e) {
            return response()->json($e->getMessage());
            //throw $th;
           }
    }
   
}
