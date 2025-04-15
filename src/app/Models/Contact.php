<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name','first_name', 'gender', 'email' ,'tel' ,'address' ,'building'  ,'detail' ,'category_id'
    ];

    public function getGenderTextAttribute()
{
    return [
        1 => '男性',
        2 => '女性',
        3 => 'その他'
    ][$this->gender] ?? '不明';
}

    public function category()
{
    return $this->belongsTo(Category::class);

}

    public function scopeCategorySearch($query, $category_id)
    {
    if (!empty($category_id)) {
        $query->where('category_id', $category_id);
    }
    }

    public function scopeGenderSearch($query, $gender)
    {
    if (!empty($gender)) {
        $query->where('gender', $gender);
    }

    }

    public function scopeCreatedAtSearch($query, $created_at)
    {
    if (!empty($created_at)) {
        return $query->whereDate('created_at', $created_at);
    }
        return $query;
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('last_name', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }
    }
}
