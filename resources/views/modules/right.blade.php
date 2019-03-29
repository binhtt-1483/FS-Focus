<div id="right" class="is-bottomPosition">
    <div class="right">
        <!-- Widget [Authors Widget]-->
        <div class="widget teams">
            <header>
                <h3 class="h6">Top Authors</h3>
                <span class="top-v1 badge-info navbar-badge" style="z-index: 100;"><a href="/user/all-auther">All</a></span>
            </header>
            <div class="blog-posts">
                @foreach($users as $user)
                    <a href="/user/{{ $user->name }}" class="element">
                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img class="img-fluid img-circle img-sm" src="{{ asset($user->avatar) }}" alt="User Image">
                            </div>
                            <div class="title"><strong>{{ str_limit($user->name, config('blog.str_limit.name')) }}</strong>
                                <div class="d-flex align-items-center">
                                    <div class="views" data-toggle="tooltip" data-placement="bottom" title="Followers"><i class="fas fa-user-plus"></i> 50</div>
                                    <div class="views" data-toggle="tooltip" data-placement="bottom" title="Posts"><i class="fas fa-pencil-alt"></i> {{ $user->articles_count }}</div>
                                    <div class="comments cup"><i class="fa fa-trophy"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <!-- Widget [Teams Widget] -->
        <div class="widget teams">
            <header>
                <h3 class="h6">Top Teams</h3>
                <span class="top-v1 badge-info navbar-badge" style="z-index: 100;"><a href="#">All</a></span>
            </header>
            <div class="blog-posts">
                @foreach ($teams['otherTeam'] as $team)
                    <a href="{{ url('team') }}" class="element">
                        <div class="item d-flex align-items-center">
                            <div class="image">
                                @if ($team->avatar)
                                    <img class="img-fluid img-sm" src="{{ asset($team->avatar) }}" alt="Team avatar">
                                @else
                                    <img class="img-fluid img-sm" src="{{ asset('/images/team-default.png') }}" alt="Team avatar">
                                @endif
                            </div>
                            <div class="title"><strong>{{ str_limit($team->name, config('blog.str_limit.name')) }}</strong>
                                <div class="d-flex align-items-center">
                                    <div class="views" data-toggle="tooltip" data-placement="bottom" title="Members"><i class="fas fa-user-friends"></i> {{ $team->users_count }}</div>
                                    <div class="views" data-toggle="tooltip" data-placement="bottom" title="Posts"><i class="fas fa-pencil-alt"></i> {{ $team->getTotalArticles($team->id) }}</div>
                                    <div class="comments cup"><i class="fa fa-trophy"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                @if (!Auth::guest())
                    @if(!$teams['yourTeam']->isEmpty())
                        <hr>
                        <div class="nav-team">
                            <span class="top-v1 badge-danger navbar-badge"><a href="#">Your Team</a></span>
                        </div>
                        @foreach ($teams['yourTeam'] as $team)
                            <a href="/team/{{ $team->slug }}">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        @if ($team->avatar)
                                            <img class="img-fluid img-sm" src="{{ asset($team->avatar) }}" alt="Your team avatar">
                                        @else
                                            <img class="img-fluid img-sm" src="{{ asset('/images/team-default.png') }}" alt="Your team avatar">
                                        @endif
                                    </div>
                                    <div class="title"><strong>{{ str_limit($team->name, config('blog.str_limit.name')) }}</strong>
                                        <div class="d-flex align-items-center">
                                            <div class="views" data-toggle="tooltip" data-placement="bottom" title="Members"><i class="fas fa-user-friends"></i> {{ $team->users_count }}</div>
                                            <div class="comments" data-toggle="tooltip" data-placement="bottom" title="Posts"><i class="fas fa-pencil-alt"></i> {{ $team->articles_count }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                    <div class="border-top text-center">
                        <a href="javascript:;" class="text-info button-toggle-team create-button"><strong><i class="fas fa-users-cog"></i> Create Team</strong></a>
                        <div class="optional-team  {{ $errors->isEmpty() ? 'hide' : ''}}">
                            <form action="{{ url('team') }}" method="POST">
                                {{ csrf_field() }}
                                <textarea class="textarea form-control box__input textarea--autoHeight" placeholder="Your Team" rows="1" name="name"></textarea>
                                <div class="mb__10"></div>
                                <button type="submit" class="btn btn-outline-info btn-sm full-width"><i class="fas fa-check text-dark"></i></button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="border-top text-center">
                        <a href="{{ url('login') }}" class="text-info create-button"><strong><i class="fas fa-users-cog"></i> Create Team</strong></a>
                    </div>
                @endif
            </div>
        </div>
        <!-- Link -->
        <div class="widget links">
            <header>
                <h3 class="h6">Links</h3>
            </header>
            <ul class="list-unstyled">
                @if(config('blog.footer.facebook.open'))
                    <li><a href="{{ config('blog.footer.facebook.url') }}" target="_blank"><i class="fab fa-facebook-square"></i> Facebook</a></li>
                @endif
                <li><a href="#" target="_blank"><i class="fab fa-twitter"></i> Twitter</a></li>
                @if(config('blog.footer.github.open'))
                    <li><a href="{{ config('blog.footer.github.url') }}" target="_blank"><i class="fab fa-github"></i> Github</a></li>
                @endif
                <li><a href="#" target="_blank"><i class="fab fa-stack-overflow"></i> Stack Overflow</a></li>
            </ul>
        </div>
    </div>
</div>