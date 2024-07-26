        <!--================================= header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="{{ route('admin.home') }}"><img
                        src="{{ asset('assets/images/logo-dark.png') }}" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('admin.home') }}"><img
                        src="{{ asset('assets/images/logo-icon-dark.png') }}" alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
                <li class="nav-item">
                    <div class="search">
                        <a class="search-btn not_click" href="javascript:void(0);"></a>
                        <div class="search-box not-click">
                            <input type="text" class="not-click form-control" placeholder="Search" value=""
                                name="search">
                            <button class="search-button" type="submit"> <i
                                    class="fa fa-search not-click"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ auth('admin')->user()->image }}" alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0">{{ auth('admin')->user()->name }}</h5>
                                    <span>{{ auth('admin')->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                class="text-warning ti-user"></i>الملف
                            الشخصي</a>
                        <form action="{{ route('admin.logout') }}" method="POST" id="sub">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault(); document.querySelector('#sub').submit()"><i
                                class="text-danger ti-unlock"></i>تسجيل الخروج</a>
                    </div>
                </li>
            </ul>
        </nav>

        <!--=================================
 header End-->
