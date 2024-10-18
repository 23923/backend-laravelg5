<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $articles = Article::with("scategorie")->get();
            return response()->json($articles);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $article = new Article([
                "designation" => $request->input("designation"),
                "reference" => $request->input("reference"),
                "marque" => $request->input("marque"),
                "prix" => $request->input("prix"),
                "qtestock" => $request->input("qtestock"),
                "scategorieID" => $request->input("scategorieID"),
                "imageart" => $request->input("imageart"),
            ]);
            $article->save();
            return response()->json($article);
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        try {
            // Le modèle Article est automatiquement résolu par son ID grâce au type-hinting
            return response()->json($article);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Article not found',
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Trouver l'article par son ID
            $article = Article::findOrFail($id);

            // Mise à jour de l'article avec les données fournies
            $article->update($request->all());

            // Retourner la réponse JSON
            return response()->json($article);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Trouver l'article par son ID
            $article = Article::findOrFail($id);
            $article->delete();
            return response()->json("Article supprimé");
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
    public function showArticlesBySCAT($idscat){
        try {
            $articles=Article::where('scategorieID',$idscat)->with('scategorie')->get();
            return response()->json($articles);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
    public function articlesPaginate(){
        try {
            $perPage=request()->input('pageSize',10);
            $articles=Article::with('scategorie')->paginate($perPage);
            return response()->json([
                'products'=> $articles->items(),
                'totalPages'=>$articles->lastPage(),
            ]);
    }
    catch (\Exception $e) {
        return response()->json($e->getMessage(), $e->getCode());
    }
    
}
}
