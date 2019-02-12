<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Services\SearchingScope;

class Attendance extends Model
{
    use SearchingScope;

    protected $table = 'attendance';

    public $timestamps = false;

    protected $dates = [
        'start_time',
        'end_time',
        'date',
    ];

    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'request_content',
        'absent_flg',
        'absent_reason',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->hasOne(DailyReport::class, 'reporting_time', 'date');
    }

    public function fetchSpecificDay($user_id, $date)
    {
        return $this->where('user_id', $user_id)
                    ->where('date', $date->format('Y-m-d'))
                    ->first();
    }

    public function fetchPersonalRecords($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('date', 'desc')
                    ->get();
    }

    public function registerStartTime($inputs)
    {
        $hasntRecord = $this->where('user_id', $inputs['user_id'])
                            ->where('date', $inputs['date'])
                            ->doesntExist();
        if ($hasntRecord) {
            $this->create($inputs);
        }
    }

    public function registerAbsence($inputs)
    {
        $this->updateOrCreate(
            ['user_id' => $inputs['user_id'], 'date' => $inputs['date']], $inputs
        );
    }

    public function registerModifyRequest($inputs)
    {
        $this->filterEqual('user_id', $inputs['user_id'])
             ->filterEqual('date', $inputs['date'])
             ->firstOrFail()
             ->fill($inputs)
             ->save();
    }

    public function setTypeAttribute($type)
    {
        dd($type);
        if ($type) {
            $this->attributes['absent_flg'] = 0;
            $this->attributes['absent_reason'] = null;
        } else {
            $this->attributes['start_time'] = null;
            $this->attributes['end_time'] = null;
            $this->attributes['absent_flg'] = 1;
        }
    }

}

