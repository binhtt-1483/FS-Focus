<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use App\Notifications\ReceivedComment as Received;

class CommentController extends ApiController
{
    protected $comment;

    public function __construct(CommentRepository $comment)
    {
        parent::__construct();

        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->response->collection($this->comment->pageWithRequest($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = array_merge($request->all(), [
            'user_id' => Auth::user()->id
        ]);

        $comment = $this->comment->store($data);

        $comment->commentable->user->notify(new Received($comment));

        return $this->response->item($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $commentableId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $commentableId)
    {
        $comments = $this->comment->getByCommentable($commentableId, $request);

        return $this->response->collection($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return $this->response->item($this->comment->getById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        $data = $request->all();

        $data['content'] = $data['content'];

        $this->comment->update($id, $data);

        return $this->response->withNoContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->comment->getById($id));

        $this->comment->destroy($id);

        return $this->response->withNoContent();
    }
}
