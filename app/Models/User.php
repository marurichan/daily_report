<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'password',
        'user_info_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $touches = [
        'info'
    ];

    public function info()
    {
        return $this->belongsTo('App\Models\UserInfos', 'user_info_id');
    }

    public function dailyReport()
    {
        return $this->hasMany('App\Models\DailyReports', 'user_id');
    }

    public function filterSearchedUsers($searchConditions, $query)
    {
        foreach ($searchConditions as $conditionName => $conditionValue) {
            switch ($conditionName) {
                case 'from_date':
                    $query->filterHireDate($conditionValue, '>=');
                    break;
                case 'to_date':
                    $query->filterHireDate($conditionValue, '<=');
                    break;
                default:
                    $query->filterCondition($conditionName, $conditionValue);
                    break;
            }
        }

        return $query;
    }

    public function scopeFilterCondition($query, $conditionName, $conditionValue)
    {
        if (!empty($conditionValue)) {
            $query->whereHas('info', function($query) use ($conditionName, $conditionValue) {
                return $query->where($conditionName, $conditionValue);
            });
        }
    }

    public function scopeFilterHireDate($query, $date, $inequality)
    {
        if (!empty($date)) {
            $query->whereHas('info', function($query) use ($date, $inequality) {
                return $query->where('hire_date', $inequality, date($date));  
            });
        }
    }

    public function getSlackUsers($userInfoId)
    {
        return $this->firstOrNew(['user_info_id' => $userInfoId]);
    }

    public function saveUser($user, $userData, $userInfoId)
    {
        $user->name = $userData->name;
        $user->password = $userData->id;
        $user->user_info_id = $userInfoId;
        $user->save();
        return $user;
    }

    public function restoreDeletedUser($userInfoId)
    {
        DB::transaction(function() use($userInfoId) {
            $this->withTrashed()->where('user_info_id', $userInfoId)->update(['deleted_at' => null]);
        });
    }
}

