<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\SearchingScope;

class Questions extends Model
{
    use SoftDeletes, SearchingScope;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
        'answer',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\TagCategory', 'tag_category_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment', 'question_id');
    }

    public function getMyPageQuestions($user_id)
    {

        return $this->where('user_id', $user_id)->orderby('created_at', 'desc')->get();

    }

    public function updateAnswer($data)
    {
        $this->find($data['id'])->update([
            "answer" => $data['answer'],
        ]);
    }

    public function getSearchingQuestion($conditions)
    {
        return $this->filterLike('title', $conditions['search_word'])
                    ->filterEqual('tag_category_id', $conditions['tag_category_id'])
                    ->orderby('created_at', 'desc');
    }
}

