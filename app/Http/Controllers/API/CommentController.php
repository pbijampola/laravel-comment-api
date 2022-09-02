<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class CommentController extends Controller
{
     /**
     * @OA\Get(
     *      path="/api/v1/comments",
     *      operationId="getComments",
     *      tags={"Comment"},
     *      summary="Get all comments",
     *      description="Returns all comments",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/comments")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        $comments=Comment::all();
        return response()->json($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

   /**
    * @OA\Post(
    *      path="/api/v1/comments",
    *      operationId="createComment",
    *      tags={"Comment"},
    *      summary="Create a new comment",
    *      description="Returns a newly created comment",
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\MediaType(
    *              mediaType="application/json",
    *              @OA\Schema(ref="#/components/schemas/comments")
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation",
    *          @OA\JsonContent(ref="#/components/schemas/comments")
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    *     )
    */
    public function store(Request $request)
    {
        request()->validate([
            "name"=>'required|string|max:15',
            "comment"=>"required|string|max:200"
        ]);

        $newcomment=Comment::create([
            'name'=>$request->name,
            'comment'=>$request->comment

        ]);
        return response()->json($newcomment);
    }

    /**
     * @OA/Get(
     *     path="/api/v1/comments/{id}",
     *    operationId="getComment",
     *   tags={"Comment"},
     *  summary="Get a comment",
     * description="Returns a single comment",
     * @OA\Parameter(
     *    name="id",
     *   in="path",
     * description="ID of comment to return",
     * required=true,
     * @OA\Schema(
     *             type="integer",
     *            format="int64"
     *        )
     * ),
     * @OA\Response(
     *         response=200,
     *        description="Successful operation",
     * @OA\JsonContent(ref="#/components/schemas/comments")
     *   ),
     * @OA\Response(
     *        response=401,
     *       description="Unauthenticated",
     * ),
     * @OA\Response(
     *       response=403,
     *     description="Forbidden"
     * )
     * )
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return response()->json($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



    }

    /**
     * @OA/Put(
     *     path="/api/v1/comments/{id}",
     *   operationId="updateComment",
     * tags={"Comment"},
     * summary="Update a comment",
     * description="Returns updated comment",
     * @OA\Parameter(
     *   name="id",
     * in="path",
     * description="ID of comment to update",
     * required=true,
     * @OA\Schema(
     *            type="integer",
     *          format="int64"
     *     )
     * ),
     * @OA\RequestBody(
     *         required=true,
     *        @OA\MediaType(
     *           mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/comments")
     *     )
     * ),
     * @OA\Response(
     *        response=200,
     *      description="Successful operation",
     * @OA\JsonContent(ref="#/components/schemas/comments")
     * ),
     * @OA\Response(
     *       response=401,
     *    description="Unauthenticated",
     * ),
     * @OA\Response(
     *     response=403,
     *  description="Forbidden"
     * )
     * )
     */
    public function update(Request $request, $id)
    {
        $validated=request()->validate([
            "name"=>'required|string|max:15',
            "comment"=>"required|string|max:200"
        ]);
        $comment=Comment::find($id);
        $comment->update($validated);
        return response()->json($comment);

        //
    }

    /**
     * @OA\Delete(
     *    path="/comments/{id}",
     *  operationId="deleteComment",
     * tags={"Comment"},
     * summary="Delete a comment",
     * description="Returns deleted comment",
     * @OA\Parameter(
     *  name="id",
     * in="path",
     * description="ID of comment to delete",
     * required=true,
     * @OA\Schema(
     *           type="integer",
     *        format="int64"
     *   )
     * ),
     * @OA\Response(
     *       response=200,
     *    description="Successful operation",
     * @OA\JsonContent(ref="#/components/schemas/comments")
     * ),
     * @OA\Response(
     *     response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     *    response=403,
     * description="Forbidden"
     * )
     * )
     */
    public function destroy($id)
    {
        if($id=!null){
            $comment=Comment::where('id',$id);
            $comment->delete();
            return response()->json($comment::all());
        }
    }
}
