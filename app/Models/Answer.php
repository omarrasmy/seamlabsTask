<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Answer extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $casts = [
        'title'=>'json',
    ];

    public $translatable = ['title'];
    protected $fillable =['title','question'];

    public function Questions(){
        return $this->belongsToMany(Question::class,'question_answer');
    }
    public function scopeQuery(Builder $query, string $search): Builder
    {
        $titleArr = [];
        array_push($titleArr, 'title');
        array_push($titleArr, 'ILIKE');
        array_push($titleArr, "%$search%");
        return $query->where([$titleArr]);
    }
}
