<?php

namespace App\Http\Controllers;
use App\Article;
use App\User;
use Illuminate\Http\Request;
use App\Comment;
use DB;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function show($id)
    {
        return Article::find($id);
    }

    public function store(Request $request)
    {
        return Article::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return 204;
    }
    public function commentArticle(Request $request)
    {
        $data =  $request->json()->all();
        //return $data["Object"];
        DB::table('comments')->insert(
            ['Object' => $data["Object"], 'objectID' => $data["objectID"],'body'=>$data["body"],'createdBy'=>$data["createdBy"]]
        );
        return response()
        ->json(['status' => 'success']);
    }

    public function getAllComment()
    {
         //return Comment::all();
          $comments = Comment::all();
            foreach ($comments as $comment) {
                $arrayComment = (array) $comment;
                array_push($arrayComment,$comment->user);           
            }
        return $comments;
    }

    public function getCommentById(Request $req)
    {
       $idArticle =  $req->get('idArticle');

       //$comments =  DB::table('comments')->where('objectID',$idArticle)->get();
       $comments =  Comment::where('objectID',$idArticle)->get();
      
        foreach ($comments as $comment) {
                $arrayComment = (array) $comment;
                array_push($arrayComment,$comment->user);           
        }
       return response()
        ->json(['data' => $comments]);
    }

    public function deleteComment(Request $req){
        $idArticle =  $req->get('idArticle');
        DB::table('comments')->where('id', $idArticle)->delete();
        return response()->json(['status'=>'success']);
    }

    public function editComment(Request $req){
        $data = $req->json()->all();
        DB::table('comments')
            ->where('id', $data['id'])
            ->update(['body' => $data['body']]);
        return response()
        ->json(['status' => 'success']);
    }
    public function test(){
        $comments = Comment::all();
        foreach ($comments as $comment) {
            $arrayComment = (array) $comment;
            array_push($arrayComment,$comment->user);           
        }
        return $comments;

    }
}
