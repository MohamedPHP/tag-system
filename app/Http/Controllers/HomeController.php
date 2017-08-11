<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use App\TagLink;
use App\Category;
use App\Atricle;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->q)) {
            $word = trim(strip_tags($request->q));
            $articles = Atricle::whereHas('tags', function ($q) use ($word) {
                return $q->where('name', $word);
            })->orWhereHas('category', function ($q) use ($word) {
                return $q->where('name', 'like', '%'.$word.'%');
            })->orWhere('title', 'like', '%'.$word.'%')->paginate(10);
        }else {
            $articles = Atricle::orderBy('id', 'desc')->paginate(10);
        }

        return view('home', compact('articles'));
    }

    public function add() {
        $tags = Tag::all();
        $cats = Category::all();
        $atricles = Atricle::all();
        return view('add', compact('tags', 'cats', 'atricles'));
    }

    public function addTag(Request $request) {

        $this->validate($request, [
            'tag_name' => 'required',
        ]);
        $tag = new Tag();
        $tag->name = $request->tag_name;
        $tag->save();
        return redirect()->back()->with(['success' => 'Tag Added']);
    }

    public function addArticle(Request $request) {
        $this->validate($request, [
            'article_title' => 'required',
            'cat_id' => 'required|numeric',
        ]);
        if (!Category::find($request->cat_id)) {
            return redirect()->back();
        }
        $art = new Atricle();
        $art->title = $request->article_title;
        $art->cat_id = $request->cat_id;
        $art->save();
        if (count($request->article_tags) > 0) {
            foreach ($request->article_tags as $key => $value) {
                if (Tag::find($value)) {
                    $taglink = new TagLink();
                    $taglink->article_id = $art->id;
                    $taglink->tag_id = $value;
                    $taglink->save();
                }
            }
        }
        return redirect()->back()->with(['success' => 'Article Added']);
    }

    public function addCategory(Request $request) {
        $this->validate($request, [
            'cat_name' => 'required',
        ]);
        $cat = new Category();
        $cat->name = $request->cat_name;
        $cat->save();
        return redirect()->back()->with(['success' => 'Cat Added']);
    }

}
