<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\NewsLetter;
use Illuminate\Http\Request;

/**
 * Class NewsLetterController
 * @package App\Http\Controllers
 */
class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:newsLetters-list',  ['only' => ['index']]);
        $this->middleware('permission:newsLetters-view',  ['only' => ['show']]);
        $this->middleware('permission:newsLetters-create',['only' => ['create','store']]);
        $this->middleware('permission:newsLetters-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:newsLetters-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsLetters = NewsLetter::get();

        return view('admin.news-letter.index', compact('newsLetters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newsLetter = new NewsLetter();
        return view('admin.news-letter.create', compact('newsLetter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $newsLetter = NewsLetter::create($request->all());
        return redirect()->route('news-letters.index')
            ->with('success', 'NewsLetter created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newsLetter = NewsLetter::find($id);

        return view('admin.news-letter.show', compact('newsLetter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsLetter = NewsLetter::find($id);

        return view('admin.news-letter.edit', compact('newsLetter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  NewsLetter $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsLetter $newsLetter)
    {
        $newsLetter->update($request->all());

        return redirect()->route('news-letters.index')
            ->with('success', 'NewsLetter updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $newsLetter = NewsLetter::find($id)->delete();

        return redirect()->route('news-letters.index')
            ->with('success', 'NewsLetter deleted successfully');
    }
}
