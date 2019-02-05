<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\SearchingScope;

class DailyReports extends Model
{
    use SoftDeletes, SearchingScope;

    protected $fillable = [
        'user_id',
        'title',
        'contents',
        'reporting_time',
    ];

    protected $dates = [
        'reporting_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // SearchingScope traitに定義されている検索用scopeを使用
    public function getAllPersonalReports($userId)
    {
        return $this->filterEqual('user_id', $userId)
                    ->orderby('reporting_time', 'desc')
                    ->get();
    }

    // SearchingScope traitに定義されている検索用scopeを使用
    public function getSearchingPersonalReports($userId, $serchConditions)
    {
        return $this->filterEqual('user_id', $userId)
                    ->filterLike('reporting_time', $serchConditions['search-month'])
                    ->orderby('reporting_time', 'desc')
                    ->get();
    }

}

