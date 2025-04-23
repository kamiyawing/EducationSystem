<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function articlesList() {
        $articlesModel = new Article();
        $articles = $articlesModel->articleGetList();
        return view('admin/article_list', compact('articles'));
    }

    public function articlesRegister(ArticleRequest $request) {
        DB::beginTransaction();
        try {
        $articleModel = new Article();
        $articleModel->store($request);
        DB::commit();
        return redirect()->route('article_list')->with('success', __('お知らせを登録しました。'));
        } catch(\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => __('お知らせの新規登録に失敗しました。')]);
        }
        //任意のViewにリダイレクト

    }

    public function articlesEdit($id) {
        $articleModel = new Article();
        $articles = $articleModel->articleGetList()->find($id);
        return view('admin/article_edit', compact('articles'));
    }

    public function update(ArticleRequest $request, $id) {
        DB::beginTransaction();
        try {
        $articleModel = new Article();
        $articleModel->articleUpdate($id, $request);
        DB::commit();
        return redirect()->route('article_list')->with('success', __('お知らせを変更しました。'));
        } catch(\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => __('お知らせの新規登録に失敗しました。')]);
        }
    }

    public function articlesDelete($id) {
        $articleModel = new Article();
        $articles = $articleModel->articleGetList()->find($id);
        $articles->delete();
        return redirect()->route('article_list')->with('success', __('お知らせを削除しました。'));
    }   
}
