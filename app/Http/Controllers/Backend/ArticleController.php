<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\ArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleCategoryRepository;
use App\Repositories\LabelRepository;
use App\Repositories\TagRepository;

class ArticleController extends Controller
{
    protected $articleRepository;
    protected $articleCategoryRepository;
    protected $labelRepository;
    protected $tagRepository;

    function __construct(ArticleRepository $articleRepository, ArticleCategoryRepository $articleCategoryRepository, LabelRepository $labelRepository, TagRepository $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->labelRepository = $labelRepository;
        $this->tagRepository = $tagRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        checkPerm('admin-article-index', true);
        return view('backend.article.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        checkPerm('admin-article-create', true);
        $categories = $this->articleCategoryRepository->options();
        $labels     = $this->labelRepository->optionByType('article');
        $tags = $this->tagRepository->all()->pluck('name', 'id');
        return view('backend.article.form', compact('categories','labels', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        checkPerm('admin-article-create', true);
        if (!$request->validated()) {
            return back()->withError();
        }
        $this->articleRepository->createNew($request->all());
        setAlert('success', 'Article is created successfully');
        return redirect('admin/articles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        checkPerm('admin-article-update', true);
        $article = $this->articleRepository->with('labels')->findOrFail($id);
        $categories = $this->articleCategoryRepository->options();
        $labels     = $this->labelRepository->optionByType('article');
        $tags = $this->tagRepository->tagList($article->tag_ids->toArray())->pluck('name', 'id');
        return view('backend.article.form', compact('article', 'categories', 'labels', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        checkPerm('admin-article-update', true);
        $this->articleRepository->update($id, $request->all(), true);
        setAlert('success', 'Article is updated successfully');
        return redirect('admin/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        checkPerm('admin-article-delete', true);
        $this->articleRepository->deleteById($id, true);
            return response()->json([
                'status'  => true,
                'message' => 'Article is deleted successfully.'
            ], 200);
    }

    /**
     * Ajax Request
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        switch ($request->mode) {
            case 'datatable':
                return $this->articleRepository->datatable();
                break;
        }
    }
}
