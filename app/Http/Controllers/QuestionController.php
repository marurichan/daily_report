<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionsRequest;
use App\Http\Requests\CommentRequest;

const MAX_PAGE_COUNT = 30;

class QuestionController extends Controller
{
    protected $question;
    protected $category;
    protected $comment;

    public function __construct(Question $question, TagCategory $category, Comment $comment)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->category = $category;
        $this->comment = $comment;
    }

    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index(Request $request)
    {
        $categories = $this->category->all();
        $inputs = $request->all();

        if (array_key_exists('search_word', $inputs)) {
            $questions = $this->question->fetchSearchingQuestion($inputs)->paginate(MAX_PAGE_COUNT);
        } else {
            $questions = $this->question->orderby('created_at', 'desc')->paginate(MAX_PAGE_COUNT);
        }

        return view('question.index', compact('questions', 'categories', 'inputs'));
    }

    public function create()
    {
        $categories = $this->category->all();
        return view('question.create', compact('categories'));
    }

    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $this->question->create($inputs);
        return redirect()->route('question.index');
    }

    public function show($id)
    {
        $question = $this->question->find($id);
        return view('question.show', compact('question'));
    }

    public function edit($id)
    {
        $categories = $this->category->all();
        $question = $this->question->find($id);
        return view('question.edit', compact('question', 'categories'));
    }

    public function update(QuestionsRequest $request, $questionId)
    {
        $inputs = $request->all();
        $this->question->find($questionId)->fill($inputs)->save();
        return redirect()->route('question.index');
    }

    public function destroy($questionId)
    {
        $this->question->find($questionId)->delete();
        return redirect()->route('question.index');
    }

    public function myPage($userId)
    {
        $questions = $this->question->fetchMyPageQuestions($userId);
        return view('question.mypage', compact('questions'));
    }

    public function confirm(QuestionsRequest $request, $questionId = null)
    {
        $inputs = $request->all();
        $category = $this->category->find($inputs['tag_category_id'])->name;
        return view('question.confirm', compact('inputs', 'category', 'questionId'));
    }

    public function storeComment(CommentRequest $request)
    {
        $inputs = $request->all();
        $this->comment->create($inputs);
        return redirect()->route('question.index');
    }

}

