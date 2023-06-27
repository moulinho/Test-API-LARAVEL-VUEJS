<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $comments = Comments::orderBy('id','desc')->get();


        return response()->json([
            'comments' => $comments
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            //code...
            Comments::create([
                'comment' => $request->comment,
            ]);

            return response()->json([
                'message' => 'Commentaire Ajouter'
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'commentaire non ajouter'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Rechercher le commentaire

        $comment = Comments::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Commentaire non trouvé'
            ], 404);
        }

        return response()->json([
            'commentaire' => $comment
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Rechercher le commentaire

        try {
            $comment = Comments::find($id);
            if (!$comment) {
                return response()->json([
                    'message' => 'Commentaire non trouvé'
                ], 404);
            }

            $comment->comment = $request->comment;

            /**
             * Ajout du commentaire en base de donnée
             *
             */
            $comment->save();

            return response()->json([
                'message' => 'Commentaire mis à jour'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Un probleme est survenu'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $comment = Comments::find($id);
        if (!$comment) {
            return response()->json([
                'message' => 'Commentaire non trouvé'
            ], 404);
        }

        $comment->delete();
        return response()->json([
            'message' => 'Commentaire supprimé'
        ], 200);
    }
}
