<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleHomeRequest;
use App\Repositories\ArticleRepository;
use Carbon\Carbon;

class ArticleController extends Controller
{
    /**
     * @var \App\Repositories\ArticleRepository
     */
    protected $article;

    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }

    /**
     * Display the articles resource.
     *
     * @return mixed
     */
    public function index()
    {
        $articles = $this->article->page(
            config('blog.article.number'), 
            config('blog.article.sort'), 
            config('blog.article.sortColumn')
        );

        return view('article.index', compact('articles'));
    }

    /**
     * Display the article resource by article slug.
     *
     * @param  string $slug
     * @return mixed
     */
    public function show($slug)
    {
        $article = $this->article->getBySlug($slug);

        $article->addViewWithExpiryDate(Carbon::now()->addMinute());
        
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a new article.
     *
     * @param  \App\Http\Requests\ArticleHomeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleHomeRequest $request)
    {
        $data = array_merge($request->all(), [
            'user_id' => \Auth::id(),
            'last_user_id' => \Auth::id(),
            'published_at' => date('Y-m-d H:i:s'),
        ]);

        //$time_now =  \Carbon\Carbon::now();

        $data['is_draft'] = isset($data['is_draft']);
        $data['is_original'] = isset($data['is_original']);
        $data['type'] = isset($data['type']);
        $data['content'] = $data['content'];

        $this->article->store($data);

        if ($request->tags) {
            $this->article->syncTag($data['tags']);
        }

        return redirect()->to('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->article->getById($id);

        $this->authorize('update', $article);

        $selectTags = $this->article->listTagsIdsForArticle($article);

        return view('article.edit', compact('article', 'selectTags'));
    }

    /**
     * Update the article by id.
     *
     * @param  ArticleHomeRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleHomeRequest $request, $id)
    {
        $article = $this->article->getById($id);

        $this->authorize('update', $article);

        $data = array_merge($request->all(), [
            'last_user_id' => \Auth::id()
        ]);

        $data['content'] = $data['content'];

        $this->article->update($id, $data);

        return redirect()->to("{$this->article->getSlug()}");
    }

}
