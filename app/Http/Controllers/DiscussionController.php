<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepository;
use App\Http\Requests\DiscussionRequest;
use App\Repositories\DiscussionRepository;
use Carbon\Carbon;

class DiscussionController extends Controller
{
    /**
     * @var \App\Repositories\DiscussionRepository
     */
    protected $discussion;

    /**
     * @var \App\Repositories\TagRepository
     */
    protected $tag;

    public function __construct(DiscussionRepository $discussion, TagRepository $tag)
    {
        $this->middleware('auth')->except(['index', 'show']);

        $this->discussion = $discussion;
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = $this->discussion->page(
            config('blog.discussion.number'),
            config('blog.discussion.sort'),
            config('blog.discussion.sortColumn')
        );

        return view('discussion.index', compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $tags = $this->tag->all();

        return view('discussion.create');
    }

    /**
     * Store a new discussion.
     *
     * @param  DiscussionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionRequest $request)
    {
        $data = array_merge($request->all(), [
            'user_id' => \Auth::id(),
            'last_user_id' => \Auth::id(),
            'status' => true
        ]);

        $data['content'] = $data['content'];

        $this->discussion->store($data);

        return redirect()->to('discussion');
    }

    /**
     * Display the specified resource with related.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussion = $this->discussion->getById($id);

        $related = $this->discussion->getRelatedDiscussions($discussion);
        
        $discussion->addViewWithExpiryDate(Carbon::now()->addMinute());

        return view('discussion.show', compact('discussion', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discussion = $this->discussion->getById($id);

        $this->authorize('update', $discussion);

        $tags = $this->tag->all();

        $selectTags = $this->discussion->listTagsIdsForDiscussion($discussion);

        return view('discussion.edit', compact('discussion', 'tags', 'selectTags'));
    }

    /**
     * Update the discussion by id.
     *
     * @param  DiscussionRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscussionRequest $request, $id)
    {
        $discussion = $this->discussion->getById($id);

        $this->authorize('update', $discussion);

        $data = array_merge($request->all(), [
            'last_user_id' => \Auth::id()
        ]);

        $data['content'] = $data['content'];

        $this->discussion->update($id, $data);

        return redirect()->to("discussion/{$id}");
    }
}
