<div class="latest-posts">
    <div class="container">
        <a href="#" class="read-next">
            <strong>Related Post <i class="fa fa-angle-right"></i></strong>
        </a>
        <hr>
        @dump($related)
        <div class="row">
            {{-- @forelse($related_articles as $article)
                <div class="post col-md-4">
                    <div class="post-thumbnail"><a href="post.html"><img src="{{ $article->page_image }}" alt="..." class="img-fluid"></a></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="date">{{ $article->published_at->toFormattedDateString() }}</div>
                        </div>
                        <a href="{{ url($article->slug) }}">
                            <h3 class="h4">{{ str_limit($article->title, '45') }}</h3>
                        </a>
                        <p class="text-muted">
                            <parse content="{{ $article->content['raw'] }}"></parse>
                        </p>
                        <footer class="post-footer d-flex align-items-center">
                            <a href="/user/{{ $article->user->name }}" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="{{ $article->user->avatar }}" alt="tran trong binh" class="img-fluid"></div>
                                <div class="title"><span>{{ $article->user->name or 'No Name' }}</span></div>
                            </a>
                            <div class="comments"><i class="far fa-comment-alt"></i> {{ $article->comments->count() }}
                            </div>
                            <div class="comments meta-last"><i class="far fa-eye"></i>{{ $article->getViews() }}
                            </div>
                        </footer>
                    </div>
                </div>
            @empty
                <h3 class="text-center">{{ lang('Nothing') }}</h3>
            @endforelse --}}
        </div>
    </div>
</div>

<div class="latest-posts">
    <div class="container">
        <a href="#" class="read-next">
            <strong>More from {{ $article->user->name }} <i class="fa fa-angle-right"></i></strong>
        </a>
        <hr>
        <div class="row">
            {{-- @forelse($related_of_author as $article)
                <div class="post col-md-4">
                    <div class="post-thumbnail"><a href="post.html"><img src="{{ $article->page_image }}" alt="..." class="img-fluid"></a></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="date">{{ $article->published_at->toFormattedDateString() }}</div>
                        </div>
                        <a href="{{ url($article->slug) }}">
                            <h3 class="h4">{{ str_limit($article->title, '45') }}</h3>
                        </a>
                        <p class="text-muted">
                            <parse content="{{ $article->content['raw'] }}"></parse>
                        </p>
                        <footer class="post-footer d-flex align-items-center">
                            <a href="/user/{{ $article->user->name }}" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="{{ $article->user->avatar }}" alt="tran trong binh" class="img-fluid"></div>
                                <div class="title"><span>{{ $article->user->name or 'No Name' }}</span></div>
                            </a>
                            <div class="comments"><i class="far fa-comment-alt"></i> {{ $article->comments->count() }}
                            </div>
                            <div class="comments meta-last"><i class="far fa-eye"></i>{{ $article->getViews() }}
                            </div>
                        </footer>
                    </div>
                </div>
            @empty
                <h3 class="text-center">{{ lang('Nothing') }}</h3>
            @endforelse --}}
        </div>
    </div>
</div>