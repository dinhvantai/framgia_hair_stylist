<header role="banner" id="fh5co-header">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="/index">{{ trans('site.hair_salon') }}</a> 
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="#" data-nav-section="home">
                            <span>{{ trans('site.home') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-nav-section="pricing">
                            <span>{{ trans('site.booking') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-nav-section="press">
                            <span>{{ trans('site.hair_style') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-nav-section="about">
                            <span>{{ trans('site.about') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-nav-section="services">
                            <span>{{ trans('site.services') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-nav-section="testimonials">
                            <span>{{ trans('site.testimonials') }}</span>
                        </a>
                    </li>
                    @if(Auth::check())
                        <li>
                            <a href="#" data-nav-section="login" >
                                <span>{{ trans('site.welcome') }} {{ Auth::user()->name }}</span>
                            </a>
                        <li>
                        <li>
                            <a href="{{ asset('logout') }}" data-nav-section="logout">
                                <span>{{ trans('site.logout') }}</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('site.login') }}" data-nav-section="login" >
                                <span>{{ trans('site.login') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('site.resgiter') }}" data-nav-section="signup">
                            <span>{{ trans('site.resgiter') }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>