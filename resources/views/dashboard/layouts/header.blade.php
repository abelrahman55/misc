@php
    $user = auth()->guard('web')->user() ?? auth()->user();
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm d-lg-none">
    <div class="container-fluid">
        <button class="btn border-0 p-2 me-2" id="sidebarToggle" type="button">
            <i class="bi bi-list fs-3 text-primary"></i>
        </button>
        
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="#">
            <img src="{{ asset('assets/logos/logo2.png') }}" alt="" height="35" onerror="this.style.display='none'">
            <span>Stamperia</span>
        </a>

        <div class="ms-auto d-flex align-items-center gap-3">
             <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown">
                    <img src="{{ optional($user)->prof_img ? asset('storage/'.optional($user)->prof_img) : asset('assets/images/user.png') }}" 
                         alt="user" width="35" height="35" class="rounded-circle border">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li class="px-3 py-2 border-bottom">
                        <div class="fw-bold">{{ optional($user)->f_name }} {{ optional($user)->l_name }}</div>
                        <small class="text-muted">{{ optional($user)->email }}</small>
                    </li>
                    <li>
                        @if(optional($user)->role == 'patient')
                            <a class="dropdown-item py-2" href="{{ route('patient_profile', ['id' => optional($user)->id]) }}">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        @else
                            <a class="dropdown-item py-2" href="{{ route('provider_profile') }}">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        @endif
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item py-2 text-danger" href="{{ route('log_out') }}">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

{{-- Navbar for Desktop (if needed/desired, but normally sidebar is enough) --}}
<header class="d-none d-lg-flex bg-white border-bottom px-4 py-2 justify-content-between align-items-center shadow-sm mb-0">
    <div>
        <h5 class="mb-0 fw-bold text-dark">Dashboard</h5>
    </div>
    <div class="d-flex align-items-center gap-4">
        <div class="position-relative">
            <i class="bi bi-bell text-muted fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">3</span>
        </div>
        
        <div class="d-flex align-items-center gap-2">
            <div class="text-end line-height-1">
                <div class="fw-bold small">{{ optional($user)->f_name }} {{ optional($user)->l_name }}</div>
                <small class="text-muted" style="font-size: 10px;">{{ ucfirst(optional($user)->type) }}</small>
            </div>
            <img src="{{ optional($user)->prof_img ? asset('storage/'.optional($user)->prof_img) : asset('assets/images/user.png') }}" 
                 alt="user" width="40" height="40" class="rounded-circle border">
        </div>
    </div>
</header>
