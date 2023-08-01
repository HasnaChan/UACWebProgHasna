@extends('layout.master')
@section('profile')
@section('content')
<section class="profile">
    <div class="mt-5">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show col" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    <div class="container d-flex container-profileTeacher bg-white mb-5">
        <div class="row">
            <div class="col border-right ms-5 me-5">
                @if ($users->photo)
                    <div class="d-flex justify-content-around mb-3">
                        <img class="rounded-circle mt-5 shadow" style="background-color: solid yellow; width: 170px; height: 170px; border-radius: 50%; overflow: hidden; object-fit: cover;" src="{{ asset('storage/'. $users->photo) }}">
                    </div>
                @else
                    <div class="d-flex justify-content-around mb-3">
                        <img class="rounded-circle mt-5 shadow" style="width: 170px; height: 170px; overflow: hidden;" src="{{ asset('img/profilespic.png') }}">
                    </div>
                @endif

                {{-- <div class="d-flex justify-content-around mt-3">
                    <form action="/logout" method="post" style="text-align: center; width: 80px;  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.15); border-radius: 10px;" class="bg-warning">
                        @csrf
                        <button type="submit" class="dropdown-item" style="font-weight: 500;" onclick="return confirm('Are you sure you want to log out?')">Logout</button>
                    </form>
                </div> --}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex col">
                            <div class="d-flex justify-content-start align-items-center mb-3">
                                <h4 class="text-right">My Profile</h4>
                            </div>
                            <div class="d-flex justify-content-end mb-4 ms-auto">
                                <a href="/profile/{{ $users->id }}/edit">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#fbc551"></path>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-right">Manage your profile information to control, protect, and secure, your account.</h6>
                    </div>
                    <div style="border: 1px solid #A08A8F;"></div>

                    <form action="/profileStudent/{{ $users->id }}" method="post">
                        @csrf
                        <div class="d-flex align-item-center mt-4" style="gap: 10px;">
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Name</label>
                            </div>
                            <input type="text" class="form-control" name="name" value="{{ $users->name }}" readonly>
                        </div>


                        <div class="d-flex align-item-center mt-4" style="gap: 10px;">
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Email</label>
                            </div>
                            <input type="text" class="form-control" name="email" value="{{ $users->email }}" readonly>
                        </div>


                        <div class="d-flex align-item-center mt-4" style="gap: 10px;">
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Gender</label>
                            </div>
                            <input type="text" class="form-control" name="gender" value="{{ $users->gender == 'male' ? 'Male' : 'Female' }}" readonly>
                        </div>

                        <div class="d-flex align-item-center mt-4" style="gap: 10px;">
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Phone Number</label>
                            </div>
                            <input type="text" class="form-control" name="phoneNumber" value="{{ $users->phoneNumber }}" readonly>
                        </div>

                        <div class="d-flex align-item-center mt-4" style="gap: 10px;">
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Job</label>
                            </div>
                            <input type="text" class="form-control" name="job" value="{{ $users->job }}" readonly>
                        </div>

                        <div class="d-flex justify-content-around mt-5">
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
