<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

    <section>
        <div class="container h-75 mt-5 mb-5">

            <div class="row justify-content-center align-items-center h-100">
                <div class="col-lg-6">
                    <div class="card text-black shadow-lg rounded-3">
                        <div class="card-body p-md-5">
                            <h1 class="text-center fw-bold mb-4 mt-2">Sign Up</h1>

                            <form class="mx-1 mx-md-4" action="/register" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Full Name -->
                                <div class="mb-1 ">
                                    <label class="form-label" for="name">Full Name</label>
                                    <i class="fas fa-user fa-lg me-3"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Full Name" />
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-1">
                                    <label class="form-label" for="email">Email</label>
                                    <i class="fas fa-envelope fa-lg me-3"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" />
                                    </div>
                                    <div>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- linkedin -->
                                <div class="mb-1">
                                    <label class="form-label" for="linkedin">LinkedIn</label>
                                    <i class="fas fa-envelope fa-lg me-3"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="text" id="linkedin" name="linkedin" class="form-control" placeholder="LinkedIn Link" />
                                    </div>
                                    <div>
                                        @error('linkedin')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- linkedin -->
                                <div class="mb-1">
                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                    <i class="fas fa-envelope fa-lg me-3"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="Your Phone Number" />
                                    </div>
                                    <div>
                                        @error('linkedin')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- job -->
                                <div class="mb-1">
                                    <label class="form-label" for="job_id">Field of Job</label>
                                    <i class="fas fa-map-marker-alt fa-lg me-3"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <select class="form-select" id="job_id" name="job_id">
                                            <option value="" disabled selected>Select your job</option>
                                            {{-- @dd($cities) --}}
                                            @foreach ($jobs as $job)
                                                <option value="{{ $job->id }}">{{ $job->jobName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('job_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <!-- Gender -->
                                <div class="mb-1 d-flex col">
                                    <div>
                                        <label class="form-label" for="gender">Gender</label>
                                    </div>
                                    <i class="fas fa-venus-mars fa-lg me-3"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                            <label class="form-check-label" for="male">Male</label>

                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Photo -->
                                <div class="mb-1">
                                    <label class="form-label" for="photo">Photo</label>
                                    <i class="fas fa-camera fa-lg me-3"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="file" id="photo" name="photo" class="form-control" accept="image/*" capture="camera" />
                                        @error('photo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="mb-5">
                                    <label class="form-label" for="password">Password</label>
                                    <i class="fas fa-lock fa-lg me-3"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mx-4 mb-1 mb-lg-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                </div>

                                <div class="text-grey-dark mt-6 text-center">
                                    Already have an account?
                                    <a class="no-underline border-b border-blue text-blue" href="/login">
                                        Login
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
