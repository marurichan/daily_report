<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\SearchingScope;

class Attendance extends Model
{
    use SearchingScope;

    protected $table = 'attendance';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'request_content',
        'absent_flg',
        'absent_reason',
        'date',
    ];

    public function getTodaysRecord($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->where('date', date('Y-m-d'))
                    ->first();
    }

    public function getPersonalRecords($user_id)
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

}

