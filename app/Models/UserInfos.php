<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\notifications\ResetPasswordNotification;
use DB;
use Carbon\Carbon;

class UserInfos extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'sex',
        'birthday',
        'email',
        'slack_user_id',
        'tel',
        'hire_date',
        'store_id',
        'access_right',
        'position_name',
        'position_code',
        'is_Registered'
    ];

    protected $dates = ['deleted_at'];

    public function admin()
    {
        return $this->hasOne('App\Models\AdminUsers', 'user_info_id');
    }

    public function scopeFilterByPositionCode($query, $position_code)
    {
        if(!$position_code) {
            return $query;
        }
        return $query->where('position_code', '<', $position_code);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function saveUserInfo($input)
    {
        $this->create([
            'first_name' => $input['first_name'],
            'last_name' =>$input['last_name'],
            'sex' => $input['sex'],
            'birthday'=>$input['birthday'],
            'email' => $input['email'],
            'tel' => $input['tel'],
            'hire_date' => $input['hire_date'],
            'store_id' => $input['store_id'],
            'access_right' => 0,
            'position_code' => 0
        ]);
    }

    public function updateUserInfo($input, $userInfoId)
    {
        DB::transaction(function() use($input, $userInfoId) {
            $this->where('id',$userInfoId)->update([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'sex' => $input['sex'],
                'birthday' => $input['birthday'],
                'email'=>$input["email"],
                'tel'=>$input['tel'],
                'hire_date'=>$input['hire_date'],
                'store_id'=>$input['store_id'],
                'access_right' => 0,
                'position_code' => 100
            ]);
        });
    }

    public function updateUserInfoCheckColumn($input, $userId)
    {
        DB::transaction(function() use($input, $userId) {
            $this->where('id',$userId)->update([
                'sex' => $input['sex'],
                'birthday' => $input['birthday'],
                'tel'=>$input['tel'],
                'hire_date'=>$input['hire_date'],
                'store_id'=>$input['store_id'],
                'is_registered'=>'1'
            ]);
        });
    }

    public function getUserRecord($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getAdminUserEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getAdminUserId($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getUserList($id)
    {
        return $this->where('store_id', $id)->get();
    }

    public function getAdminUsersByPositionCode($admin_user_info_id)
    {
        $adminuser = $this->when($admin_user_info_id, function($query) use ($admin_user_info_id) {
                         return $query->where('id', $admin_user_info_id);
                     })->first();
        return $this->filterByPositionCode($adminuser['position_code'])->get();
    }

    public function getEmailByUserInfoId($user_info_id)
    {
        return $this->when($user_info_id, function($query) use ($user_info_id) {
            return $query->where('id', $user_info_id);
        })->get();
    }

    public function getUserInfoByAdminUserId($admin_user_id)
    {
        return $this->whereHas('admin', function($query) use ($admin_user_id) {
            return $query->when($admin_user_id, function($query) use ($admin_user_id){
                return $query->where('id', $admin_user_id);
            });
        })->get();
    }

    public function permitAccessRights($admin_user_info_id, $access_rights)
    {
        // 全てのアクセス権限のフラグを組み合わせ、一つの文字列にする 例）011
        $access_right_strbin =  $access_rights['admin_right']
                               .$access_rights['user_right']
                               .$access_rights['store_right'];

        // 文字列から数字へ変換
        $access_right = bindec($access_right_strbin);

        // アクセスを許可
        return $this->where('id', $admin_user_info_id)->update(['access_right' => $access_right]);
    }

    public function updateIsRegistered($userId)
    {
        DB::transaction(function() use($userId) {
            $this->where('id',$userId)->update(['is_registered' => 1]);
        });
    }

}

