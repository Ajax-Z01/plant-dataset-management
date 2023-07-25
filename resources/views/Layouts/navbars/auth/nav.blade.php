<!-- Navbar -->
<nav class="navbar navbar-expand-lg py-3 mb-1 shadow-none" style="background-color: #FFFBE9; color: #285430">
    <div class="container-fluid mx-2">
        <a class="navbar-brand text-wrap" href="{{ route('dashboard') }}">
            <img src="{{asset('assets/img/logos/dataset-leaf.png')}}" class="navbar-brand-img" style="width:20px; height:20px" alt="...">
            <span class="ms-2 font-weight-bold" style="color: #285430">Plants Dataset</span>
        </a>
        <div class="justify-content-end">
            <button class="navbar-toggler font-weight-bold px-3 py-2 rounded shadow-none" style="color: #263A29" type="button" data-bs-toggle="collapse" data-bs-target="#dropdown03" aria-controls="dropdown03" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="dropdown03">
            {{-- <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="dropdownMenuButton" role="button" style="color: #285430" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer d-none d-lg-block" style="font-size: 20px"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                            <div class="d-flex py-1">
                                <div class="my-auto">
                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold">New message</span> from Laur
                                </h6>
                                <p class="text-xs text-secondary mb-0">
                                    <i class="fa fa-clock me-1"></i>
                                    13 minutes ago
                                </p>
                                </div>
                            </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                            <div class="d-flex py-1">
                                <div class="my-auto">
                                <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold">New album</span> by Travis Scott
                                </h6>
                                <p class="text-xs text-secondary mb-0">
                                    <i class="fa fa-clock me-1"></i>
                                    1 day
                                </p>
                                </div>
                            </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul> --}}
            <ul class="navbar-nav pe-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold px-3 py-2 rounded shadow-none" style="color: #285430" href="#" id="dropdown03link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-sm-inline">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu overflow-auto mt-0" aria-labelledby="dropdown03link">
                        <li><a class="dropdown-item" style="color: #285430" href="{{ url('profile') }}">Profile</a></li>
                        <li><a class="dropdown-item" style="color: #285430" href="{{ url('login') }}">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        
    </div>
    
</nav>
<div class="border-bottom m-auto" style="width: 85%; opacity: 0.5"></div>
<!-- End Navbar -->