@extends('layout.master')
@section('profile')
@section('content')
<section class="profileStudent p-0 py-4">

    <div class="">

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

    <div class="container col container-profileStudent bg-white mb-5">


        <div class="row">

            <div class="col">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">My Profile</h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-right">Manage your profile information to control, protect, and secure, your account.</h6>
                    </div>
                    <div style="border: 1px solid black;"></div>

                <form class="row mt-3" action="/profile/{{ $users->id }}" method="post" id="form-control"  enctype="multipart/form-data">
                    @method('PUT')
                        @csrf

                        <div class="col">

                            <div class="container col-md-3 row mt-2 d-flex m-auto justify-content-center" style="width: fit">


                                <div class="mt-1 d-flex justify-content-around align-items-center ">


                                    <input type="hidden" name="oldImage" value="tes">

                                    @if ($users->photo)
                                        <div style="display: flex; justify-content:center;">

                                            <img src="{{ asset('storage/' . $users->photo) }}" class="img-preview img-fluid img-fluid"
                                            style="display:block; border-radius: 50%; max-height: 100%;width: 200px;
                                            height: 200px;
                                            border-radius: 50%;
                                            border:solid black; overflow:hidden; object-fit: cover; ">

                                        </div>

                                    @else
                                        <div class="mt-3 d-flex justify-content-start align-items-start float-left" >
                                            <img class=" img-preview img-fluid " style="display:block; border-radius: 50%; max-height: 100%;width: 200px;
                                            height: 200px;
                                            border-radius: 50%;
                                            border:solid black;">
                                        </div>

                                    @endif
                                </div>



                                <div class="container d-flex justify-content-center align-items-center mt-3">
                                    <div class="photo-input">
                                        <input type="file" id="photoProfile" name="photo" accept="image/*" class="photo" onchange="previewImage()" >
                                    </div>
                                </div>


                                <div style="border: 1px ; margin:10px;"></div>
                            </div>
                        </div>

                        <div>

                        </div>


                        {{-- Name --}}
                        <div class="d-flex align-item-center mt-4" style="gap: 10px;">
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Name</label>
                            </div>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter your name" value="{{ old('name', $users->name) }}" style="border: solid black;">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>



                        {{-- Email --}}
                        <div class="d-flex align-item-center mt-4" style="gap: 10px;">
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Email</label>
                            </div>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" value="{{ old('email', $users->email) }}" style="border: solid black;">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        {{-- Gender --}}
                        <div class="d-flex align-item-center mt-4" style="gap:10px" >
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Gender</label>
                            </div>

                            <div class="d-flex align-item-center " style="gap:10px">
                                <div class="form-check">
                                    <input class="form-check-input genderselect" type="radio" name="gender" id="gender" value="1" style="border: solid black;" checked readonly>
                                    <label class="form-check-label" for="gender">
                                    Male
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="0" style="border: solid black;" checked readonly>
                                    <label class="form-check-label" for="gender">
                                    Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- job --}}
                        <div class="d-flex align-item-center mt-4" style="gap: 10px;">
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Job</label>
                            </div>
                            <select class="form-select @error('job') is-invalid @enderror" name="job" style="border: solid black;">
                                <option value="" disabled selected>Select your job</option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}" @if (old('job', $users->job_id) == $job->id) selected @endif>{{ $job->jobName }}</option>
                                @endforeach
                            </select>
                            @error('job')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        {{-- phoneNumber --}}
                        <div class="d-flex align-item-center mt-4" style="gap: 10px;">
                            <div class="d-flex">
                                <label class="labels text-align-right" style="height:fit-content; width: 120px; margin:auto; text-align: right;">Phone Number</label>
                            </div>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your phone number" value="{{ old('phoneNumber', $users->phoneNumber) }}" style="border: solid black;">
                            @error('phoneNumber')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                    </div>
                    <div class="mb-5 text-center" >
                        <button type="submit" class="badge bg-warning border-0" onclick="return confirm('Are you sure you want to save the changes?')" style="width: 100px; height: 40px;">Save</button></div>


                </form>

                <div class="container mx-auto d-flex justify-content-center" >

                    <form action="/deleteImg/{{ $users->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="border-0 bg-white editdelete" onclick="return confirm('Are you sure you wanna delete your photo?')">
                            Delete Image<svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 12V17" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 12V17" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button>
                    </form>

                </div>



            </div>
        </div>
    </div>





</section>
<script>

    function previewImage(){
        const image = document.querySelector('#photoProfile');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        imgPreview.style.borderRadius = '50%';
        imgPreview.style.maxHeight = '100%';
        imgPreview.style.objectFit = 'width';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFRevent){
            imgPreview.src = oFRevent.target.result;
        }
    }



</script>
@endsection
