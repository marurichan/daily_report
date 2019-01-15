<?php

namespace App\Http\Controllers;

use App\Models\TagCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionsRequest;
use App\Models\Questions;

class QuestionController extends Controller
{
    protected $question;
    protected $category;

    public function __construct(Questions $question, TagCategory $category)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->category = $category;
    }

    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index(Request $request)
    {
        $categories = $this->category->all();
        $conditions = $request->all();
        if (empty($conditions)) {
            $questions = $this->question->orderby('created_at', 'desc')->get();
        } else {
            $questions = $this->question->getSearchingQuestion($conditions);
        }
        return view('question.index', compact('questions', 'categories', 'conditions'));
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
        $questions = $this->question->find($id);
        return view('question.show', compact('questions'));
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
        $this->question->find($id)->delete();
        return redirect()->route('question.index');
    }

    public function myPage($userId)
    {
        $questions = $this->question->getMyPageQuestions($userId);
        return view('question.mypage', compact('questions'));
    }

    public function confirm(QuestionsRequest $request, $questionId = null)
    {
        $inputs = $request->all();
        $category = $this->category->find($inputs['tag_category_id'])->name;
        return view('question.confirm', compact('inputs', 'category', 'questionId'));
    }

}

