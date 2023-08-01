@if (!in_array(request()->route()->getName(), ['login', 'register']))
    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-dark" href="#">FIndJobs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center"> <!-- Add justify-content-center class here -->
                    <li class="nav-item">
                        @if (auth()->check())
                        <div class="d-flex col">
                            <div>
                                <a class="nav-link {{ request()->route()->getName() === 'home' ? 'text-dark' : 'text-light' }} {{ request()->route()->getName() === 'home' ? 'active' : '' }}" aria-current="page" href="/home">Home</a>
                            </div>
                        </div>
                        @else
                        <a class="nav-link {{ request()->route()->getName() === 'home' ? 'text-warning' : 'text-light' }} {{ request()->route()->getName() === 'home' ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                        @endif
                    </li>
                </ul>
                @if(!auth()->check())
                <a href="/login" class="btn btn-warning me-3">Login</a>
                <a href="/register" class="btn btn-light text-dark">Register</a>
                @else
                <div class="d-flex align-items-center">
                    <span class="text-light me-2">Hi, {{ Auth::user()->name }}</span>
                    <a href="#" class="btn btn-dark me-3" onclick="confirmLogout()">Logout</a>
                    <a href="/profile"><img src="{{ asset('storage/'.auth()->user()->photo) }}" alt="Profile Photo" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;"></a>
                </div>
                @endif
            </div>
        </div>
    </nav>
@endif
<script>
    function confirmLogout() {
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = "/logout"; // Redirect to the logout URL if confirmed
        }
    }
</script>
