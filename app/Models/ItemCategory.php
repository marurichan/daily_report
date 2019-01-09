<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Items;

class ItemCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category',
    ];

    protected $dates = ['deleted_at'];

    public function createItemCategory($data)
    {
        $this->create([
            'category' => $data['category']
        ]);
    }

    public function updateItemCategory($data)
    {
        $this->where('id', $data['id'])->update([
            'category' => $data['category']
        ]);
    }

}

