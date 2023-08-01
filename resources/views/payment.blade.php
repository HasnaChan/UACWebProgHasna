<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

    <section >
        <div class="container h-75 mt-5 mb-5">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-lg-6">
                    <div class="card text-black shadow-lg rounded-3">
                        <div class="card-body p-md-5">
                            <h1 class="text-center fw-bold mb-4 mt-2">Payment</h1>

                            @if (session('registerSuccess'))
                            <div class="alert alert-success">
                                {{ session('registerSuccess') }}
                            </div>
                        @endif

                            <form action="/pay" method="POST">
                                @csrf

                                <form action="/user/top-up" method="post" class="mt-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        @csrf
                                        @method('put')

                                        <div class="d-flex col justify-content-center">
                                            <div class="p-1">
                                                <input type="number" id="walletAmount" value="0" class="form-control  me-2" name="wallet">
                                            </div>
                                            <div class="p-1">
                                                <button type="button" onclick="addAmount()" class="btn btn-danger text-white">
                                                    +
                                                </button>
                                            </div>
                                            <div class="p-1">
                                                <button type="submit" class="btn btn-primary">
                                                    Top Up
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                                <div class="mb-1">
                                    <i class="fas fa-envelope fa-lg me-3"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="number" class="form-control" name="payment" placeholder="Input Your Payment" required/>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mx-4 mb-1 mb-lg-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Pay</button>
                                </div>
                            </form>

                            <div class="text-grey-dark mt-6 text-center">
                                Don't have an account?
                                <a class="no-underline border-b border-blue text-blue" href="/register">
                                    Register
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>
</html>
