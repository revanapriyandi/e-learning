<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1" />
                <rect x="1.56" y="7.5" width="16" height="1" />
                <rect x="1.56" y="15.5" width="16" height="1" />
            </svg>
        </a>
        
        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1" />
                <rect x="0.5" y="7.5" width="25" height="1" />
                <rect x="0.5" y="15.5" width="25" height="1" />
            </svg>
        </a>
        
        <div class="search" data-search-path="Pages.Search.html?q=">
            <input placeholder="Search...">
            <span class="search-icon">
                <i class="simple-icon-magnifier"></i>
            </span>
        </div>
        
    </div>
    
    
    <a class="navbar-logo" href="{{ route('home') }}">
        <strong><h1>{{ config('app.name') }}</h1></strong>
    </a>
    
    <div class="navbar-right">
        <div class="header-icons d-inline-block align-middle">
            
            <div class="position-relative d-none d-sm-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="simple-icon-grid"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-equalizer d-block"></i>
                    <span>Settings</span>
                </a>
                
                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-male-female d-block"></i>
                    <span>Users</span>
                </a>
                
                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-puzzle d-block"></i>
                    <span>Components</span>
                </a>
                
                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-bar-chart-4 d-block"></i>
                    <span>Profits</span>
                </a>
                
                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-file d-block"></i>
                    <span>Surveys</span>
                </a>
                
                <a href="#" class="icon-menu-item">
                    <i class="iconsminds-suitcase d-block"></i>
                    <span>Tasks</span>
                </a>
                
            </div>
        </div>
        
        <div class="position-relative d-inline-block">
            <button class="header-icon btn btn-empty" type="button" id="notificationButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="simple-icon-bell"></i>
            <span class="count">3</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
            <div class="scroll">
                <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                    <a href="#">
                        <img src="img/profile-pic-l-2.jpg" alt="Notification Image"
                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                    </a>
                    <div class="pl-3">
                        <a href="#">
                            <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                            <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                    <a href="#">
                        <img src="img/notification-thumb.jpg" alt="Notification Image"
                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                    </a>
                    <div class="pl-3">
                        <a href="#">
                            <p class="font-weight-medium mb-1">1 item is out of stock!</p>
                            <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                    <a href="#">
                        <img src="img/notification-thumb-2.jpg" alt="Notification Image"
                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                    </a>
                    <div class="pl-3">
                        <a href="#">
                            <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>
                            <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-row mb-3 pb-3 ">
                    <a href="#">
                        <img src="img/notification-thumb-3.jpg" alt="Notification Image"
                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                    </a>
                    <div class="pl-3">
                        <a href="#">
                            <p class="font-weight-medium mb-1">3 items just added to wish list by a user!
                            </p>
                            <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</div>

<div class="user d-inline-block">
    <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    <span class="name">{{ auth()->user()->nama }}</span>
    <span>
        <img alt="Profile Picture" src="{{ auth()->user()->avatar }}" />
    </span>
</button>

<div class="dropdown-menu dropdown-menu-right mt-3">
    @if (auth()->user()->role == 'guru')
    <a class="dropdown-item" href="{{ route('guru.show',auth()->user()->username) }}">Account</a>
    @else
    <a class="dropdown-item" href="{{ route('siswa.show',auth()->user()->username) }}">Account</a>
    @endif
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">Sign out</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
</div>
</div>
</nav>