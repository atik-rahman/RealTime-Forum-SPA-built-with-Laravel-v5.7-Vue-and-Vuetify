<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\QuestionResource;
use App\Model\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return response(Question::latest()->get());
        return QuestionResource::collection(Question::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $que = new Question();
        $que->title = $request->get('title');
        $que->slug = str_slug($request->get('title'));
        $que->body = $request->get('body');
        $que->user_id = $request->get('user_id');
        $que->category_id = $request->get('category_id');

        if($que->save()){
            return response('New question has successfully been added.', Response::HTTP_CREATED);
        }

        return response('Question could not be added due to an ERROR! Please try again later.', Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $frm = $request->all();
        $question->title = (isset($frm['title']) && $frm['title'] != '')? $frm['title'] : $question->title;
        $question->slug = str_slug($question->title);
        $question->body = (isset($frm['body']) && $frm['body'] != '')? $frm['body'] : $question->body;
        $question->user_id = (isset($frm['user_id']) && $frm['user_id'] != '')? $frm['user_id'] : $question->user_id;
        $question->category_id = (isset($frm['category_id']) && $frm['category_id'] != '')? $frm['category_id'] : $question->category_id;

        if($question->update()){
            return response('Question has successfully been updated.', Response::HTTP_OK);
        }

        return response('Question could not be updated due to an ERROR! Please try again later.', Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if($question->delete()){
            return response('Question has successfully been deleted.', Response::HTTP_OK);
        }

        return response('Question could not be deleted due to an ERROR! Please try again later.', Response::HTTP_NOT_IMPLEMENTED);
    }
}
