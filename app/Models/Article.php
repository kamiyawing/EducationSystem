<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'posted_date',
        'article_contents',
    ];

    public function articleGetList() {
        $articleData = Article::all();
        return $articleData;
    }

    public function store($request) {
        Article::create([
            'title' => $request->input('title'),
            'posted_date' => $request->input('posted_date'),
            'article_contents' => $request->input('article_contents'),
          ]);
    }

    public function articleUpdate($id, $request) {
        Article::where('id', $id)->update([
            'title' => $request->input('title'),
            'posted_date' => $request->input('posted_date'),
            'article_contents' => $request->input('article_contents'),
      ]);
    }
}
