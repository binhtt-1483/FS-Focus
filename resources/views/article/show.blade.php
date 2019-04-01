@extends('layouts.app')
@section('title', $article->title)
@section('styles')
<link rel="stylesheet" href="{{ asset(mix('css/detail-post.css')) }}">
<style>
.author__more {
    position: absolute;
    left: 82%;
    top: 0;
    bottom: 0;
    width: 220px;
}

.trailing {
    width: inherit;
}

.box {
    position: fixed;
    bottom: 0;
    z-index: 2;
    width: inherit;
    background: #FFF;
    -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.35);
    -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.35);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0.35);
    padding: 0 10px;
}

.author-subscribe {
    border-bottom: 1px solid #EEE;
    padding-bottom: 15px;
    margin-bottom: 10px;
}

.heading {
    font-size: 13px;
    line-height: 20px;
    padding: 0 15px 10px;
}

.author {
    padding: 8px 0 44px 45px;
    margin: 0 15px;
    background: #FFF;
    position: relative;
}

.author .avatar {
    width: 40px;
    height: 40px;
    display: block;
    border-radius: 50%;
    overflow: hidden;
    float: left;
    margin-left: -45px;
}

.author .avatar img {
    max-width: 100%;
    max-height: 100%;
}

.author .title {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.author .title .display-name {
    font-family: SFD-Bold;
    color: #333;
    font-size: 14px;
    line-height: 18px;
}

.author .title .nickname {
    font-size: 13px;
    line-height: 16px;
    color: #999;
}

.fixed-plugin {
    position: fixed;
    top: 200px;
    right: 0;
    width: 50px;
    background: rgba(0, 0, 0, .3);
    z-index: 1031;
    border-radius: 8px 0 0 8px;
    text-align: center;
}

.fixed-plugin .fa-cog {
    color: #FFFFFF;
    padding: 10px;
    border-radius: 0 0 6px 6px;
    width: auto;
}

.fixed-plugin .dropdown-menu {
    right: 80px !important;
    left: auto !important;
    width: 200px;
    border-radius: 10px;
    padding: 0 10px;
}

.fixed-plugin .dropdown .dropdown-menu {
    -webkit-transform: translateY(-15%);
    -moz-transform: translateY(-15%);
    -o-transform: translateY(-15%);
    -ms-transform: translateY(-15%);
    transform: translateY(-15%);
    top: -20px !important;
    opacity: 0;
    right: 0;
    transform-origin: 0 0 !important;
}

.fixed-plugin .dropdown.open .dropdown-menu {
    opacity: 1;
    -webkit-transform: translateY(-13%) !important;
    -moz-transform: translateY(-13%) !important;
    -o-transform: translateY(-13%) !important;
    -ms-transform: translateY(-13%) !important;
    transform: translateY(-13%) !important;
    transform-origin: 0 0 !important;
}

.fixed-plugin .dropdown-menu:before,
.fixed-plugin .dropdown-menu:after {
    content: "";
    display: inline-block;
    position: absolute;
    top: 70px;
    width: 16px;
    transform: translateY(-50%);
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);

}

.fixed-plugin .dropdown-menu:before {
    border-bottom: 16px solid rgba(0, 0, 0, 0);
    border-left: 16px solid rgba(0, 0, 0, 0.2);
    border-top: 16px solid rgba(0, 0, 0, 0);
    right: -17px;
}

.fixed-plugin .dropdown-menu:after {
    border-bottom: 16px solid rgba(0, 0, 0, 0);
    border-left: 16px solid #FFFFFF;
    border-top: 16px solid rgba(0, 0, 0, 0);
    right: -16px;
}

.fixed-plugin {
    top: 210px;
}
</style>
@endsection
@section('content')
<div class="article container body-white">
    <div class="row">
        <main class="col-lg-12">
            <div class="float-left action__social">
                <div class="links fixed-link">
                    <ul class="list-unstyled">
                        <li>
                            <vote></vote>
                            {{-- @if(Auth::guest())
                            <clap article-id="{{ $article->id }}" api="article" vote-count="{{ $article->countUpVoters() }}"></clap>
                            @else
                            <clap article-id="{{ $article->id }}" api="article" vote-count="" can-vote></clap>
                            @endif --}}
                        </li>
                        <li><a href="#"><i class="fas fa-bookmark"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="detail--post">
                <div class="container center-content__800px mt-4 mb-4">
                    <div class="row">
                        <div class="ml-3 w-60 d-flex align-items-center">
                            <a href="/user/{{ $article->user->name }}">
                                <img src="{{ $article->user->avatar }}" alt="{{ $article->user->name }}" class="avatar__60px align-middle">
                            </a>
                        </div>
                        <div class="col">
                            <div class="text-small text-small__black">
                                <a href="/user/{{ $article->user->name }}" class="author-name">
                                    {{ $article->user->name or 'No Name' }}
                                </a>
                            </div>
                            <div class="text-small text-light__grey truncate-line__2">
                                Software Developer and Medium fan.
                            </div>
                            <div class="text-small text-light__grey truncate-line__1">
                                <a href="#">
                                    {{ $article->published_at->diffForHumans() }}
                                </a>
                                <span>&middot;</span>
                                <a href="#">
                                    8 min read
                                </a>
                                <span>&middot;</span>
                                <a href="">
                                    <i class="far fa-eye"></i> {{ $article->getViews() }}
                                </a>
                                <span>&middot;</span>
                                <a href="">
                                    <i class="far fa-comment-alt"></i> {{ $article->comments_count }}
                                </a>
                            </div>
                            <div class="card__share">
                                <div class="card__social">
                                    <a class="share-icon edit" href="#"><span class="fas fa-pencil-alt"></span></a>
                                    <a class="share-icon delete" href="#"><span class="fas fa-trash-alt"></span></a>
                                    <a class="share-icon report" href="#"><span class="fas fa-flag"></span></a>
                                </div>
                                <a id="share" class="share-toggle action-toggle share-icon" href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container center-content__800px mb-4">
                    <h1>{{ $article->title }}</h1>
                    @if($article->category_id)
                        <a href="{{ url('category', ['name' => $article->category->name]) }}" class="topic--post"> {{ $article->category->name }}</a>
                    @endif
                    <div class="markdown ql-editor">
                        {!! $article->content['html'] !!}
                    </div>
                    <div class="mb__20"></div>
                    <div class="display__inline">
                        @if(count($article->tags))
                            <span class="post-tags">
                                @foreach($article->tags as $tag)
                                <a href="{{ url('tag', ['tag' => $tag->tag]) }}" class="tag">#{{ $tag->tag }}</a>
                                @endforeach
                            </span>
                        @endif

                        @if(config('blog.social_share.article_share'))
                            <span class="float-right">
                                <div class="social-share" data-title="{{ $article->title }}" data-description="{{ $article->title }}" {{ config('blog.social_share.sites') ? "data-sites=" . config('blog.social_share.sites') : '' }} {{ config('blog.social_share.mobile_sites') ? "data-mobile-sites=" . config('blog.social_share.mobile_sites') : '' }} initialized>
                                </div>
                            </span>
                        @endif
                    </div>
                </div>
                {{-- @if(Auth::guest())
                <comment title="You must be logged to add a comment !" commentable-type="articles" commentable-id="{{ $article->id }}" comment-number="{{ $article->comments_count }}" null-text="">
                </comment>
                @else
                <comment title="Bình luận" username="{{ Auth::user()->name }}" user-avatar="{{ Auth::user()->avatar }}" commentable-type="articles" commentable-id="{{ $article->id }}" comment-number="{{ $article->comments_count }}" null-text="" can-comment>
                </comment>
                @endif --}}
            </div>
            {{-- <div class="float-right author__more">
                <div class="trailing">
                    <div class="box is-expose" id="popup-box">
                        <a class="box-close float-right" href="#">×</a><br>
                        <div class="author-subscribe">
                            <div class="author">
                                <a class="avatar" href="/nguoi-dung/Huskywannafly">
                                    <img alt="avatar" src="https://s3-ap-southeast-1.amazonaws.com/img.spiderum.com/sp-xs-avatar/e22f6990295011e7a999e7b5135b7d88.jpg">
                                </a>
                                <div class="title">
                                    <a class="display-name" href="/nguoi-dung/Huskywannafly">
                                        Huskywannafly
                                    </a>
                                    <div class="nickname">@Huskywannafly</div>
                                </div>
                                <div class="action">
                                    <a class="btn btn-round btn-default btn-follow" title="Theo dõi Huskywannafly">
                                        Theo dõi
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id="suggested-post">
                                <h3 class="heading">Bài đăng khác</h3>
                                <!---->
                                <ul class="list-article list-unstyled clearfix">
                                    <!---->
                                    <li class="item-article">
                                        <a class="block" fragment="suggested" href="/bai-dang/Tai-sao-khong-nen-doc-sach-self-help-6jw#suggested">
                                            <h6 class="title">Căn bệnh ung thư mang tên Self-help</h6>
                                        </a>
                                    </li>
                                    <li class="item-article">
                                        <a class="block" fragment="suggested" href="/bai-dang/Ve-Can-benh-ung-thu-mang-ten-Self-help-6k3#suggested">
                                            <h6 class="title">Về: "Căn bệnh ung thư mang tên Self-help"</h6>
                                        </a>
                                    </li>
                                    <li class="item-article">
                                        <a class="block" fragment="suggested" href="/bai-dang/Den-Spiderum-de-nghe-su-bat-dong-6km#suggested">
                                            <h6 class="title">Đến Spiderum để nghe ý kiến trái chiều</h6>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!---->
                    </div>
                </div>
            </div> --}}
            <div class="fixed-plugin">
                <div class="dropdown show-dropdown open">
                    <a href="#" data-toggle="dropdown">
                        <i class="fa fa-cog fa-2x"> </i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header-title" style="min-height: 200px;"> Sidebar Filters</li>
                    </ul>
                </div>
            </div>
        </main>
    </div>
</div>
<div class="cmt">
    <div class="comments">
        <div class="comment-wrap">
            <div class="photo">
                <div class="avatar" style="background-image: url('https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg')"></div>
                <div class="vote-cmt">
                    <vote></vote>
                </div>
            </div>
            <div class="comment-block">
                <div class="author-comment" style="padding-bottom: 20px; margin-top: -15px">
                    <a class="display-name" href="/nguoi-dung/Huskywannafly" style="color: #03a87c;text-decoration: none;font-size: 16px;line-height: 1.4; cursor: pointer; text-rendering: auto;">
                        Huskywannafly
                    </a>
                    <a class="btn btn-outline-info btn-sm" title="Theo dõi Huskywannafly" style="color: #4da9ea; padding: 0 2px 0 2px; margin-left: 20px;">Theo dõi</a> 
                    <div class="comment-date" style="color: #999; font-size: 0.75rem;">Aug 24, 2014 @ 2:35 PM</div>
                </div>
                <div>
                    <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto temporibus iste nostrum dolorem natus recusandae incidunt voluptatum. Eligendi voluptatum ducimus architecto tempore, quaerat explicabo veniam fuga corporis totam reprehenderit quasi
                        sapiente modi tempora at perspiciatis mollitia, dolores voluptate. Cumque, corrupti?</p>
                </div>
                <div class="bottom-comment">
                    <div class="comment-interactive">
                        
                    </div>
                    <ul class="comment-actions">
                        <li class="complain">Complain</li>
                        <li class="reply">Reply</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="comment-wrap">
            <div class="photo">
                <div class="avatar" style="background-image: url('https://s3.amazonaws.com/uifaces/faces/twitter/felipenogs/128.jpg')"></div>
                <div class="vote-cmt">
                    <vote></vote>
                </div>
            </div>
            <div class="comment-block">
                <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto temporibus iste nostrum dolorem natus recusandae incidunt voluptatum. Eligendi voluptatum ducimus architecto tempore, quaerat explicabo veniam fuga corporis totam.</p>
                <div class="bottom-comment">
                    <div class="comment-date">Aug 23, 2014 @ 10:32 AM</div>
                    <ul class="comment-actions">
                        <li class="complain">Complain</li>
                        <li class="reply">Reply</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="comment-wrap">
            <div class="photo">
                <div class="avatar" style="background-image: url('https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg')"></div>
            </div>
            <div class="comment-block">
                <form action="">
                    <textarea name="" id="" cols="30" rows="3" placeholder="Add comment..."></textarea>
                </form>
            </div>
        </div>
    </div>
    <div class="pb__100"></div>
</div>
@endsection
@section('scripts')
@endsection