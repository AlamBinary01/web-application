<nav id="sidebar" class="col-md-3 col-lg-2 bg-dark text-white sidebar collapse d-md-block">
    <button class="close-btn" id="closeSidebar">&times;</button>
    <div class="position-sticky">
        <div class="logo-container text-center mb-3" style="margin:auto;padding:10px">
            <img src="{{asset('images/1.png')}}" alt="Logo" class="logo" style="max-width: 100%; height: auto;
    max-height: 60px;">
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="ms-2">Users</span>
                </a>
            </li>
            <!-- Add more links as needed -->
        </ul>
    </div>
</nav>
