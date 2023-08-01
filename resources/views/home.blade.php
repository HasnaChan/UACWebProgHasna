@extends('layout.master')
@section('home')
@section('content')

@php
    use App\Models\User;
    use App\Models\Matched;
@endphp

<div class="container mx-auto">
    @if (auth()->check())
    <!-- Check auth user -->

    <div class="mt-4 text-end">
        <h3 class="text-sm">
            Your Wallet : {{ auth()->user()->wallet }}
        </h3>
        <form action="/user/top-up" method="post" class="mt-4">
            <div class="d-flex align-items-center justify-content-end">
                @csrf
                @method('put')

                <div class="d-flex col justify-content-end">
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

    @else
    <!-- User is not authenticated -->
    <div class="mt-4 text-center">
        <h3 class="text-sm">Please log in</h3>
    </div>
    @endif

    <!-- Filter  -->
    @if (auth()->check())
    <form action="/home" method="GET">
        <div class="mt-4 d-flex col">
            <div>
                <select class="form-select me-2" id="job_id" name="job_id" style="width: 200px;">
                    <option value="">Select your jobs</option>
                    @foreach ($jobs as $job)
                        <option value="{{ $job->id }}" @if ($job->id == request('job_id')) selected @endif>{{ $job->jobName }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" id="applyButton">Apply</button>
            </div>
        </div>
    </form>
    @endif

        {{-- List  --}}
        <h2 class="text-sm mt-5">
            Find Your Friends
        </h2>
    {{-- @dd($users) --}}
        @auth
            <div class="row mt-4" id="userCards">
                @foreach($users as $user)

                @php
                    if(auth()->user()->gender == 'male'){
                        $cekMatch = Matched::where('manid', '=', auth()->user()->id)->where('womanid', '=', $user->id)->first();
                    }else{
                        $cekMatch = Matched::where('womanid', '=', auth()->user()->id)->where('manid', '=', $user->id)->first();
                    }
                @endphp

                @if ($cekMatch == null)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/'.$user->photo) }}" class="card-img-top" alt="User Photo" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">{{ $user->job->jobName }}</p>

                                <div class="d-flex col justify-content-around">
                                    <form action="/dislike" method="POST">
                                        @csrf
                                        <input type="hidden" name="loved_user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-warning" >
                                            <span style="font-size: 1.2rem;">&hearts;</span> Dislike
                                        </button>
                                    </form>

                                    <form action="/love" method="POST">
                                        @csrf
                                        <input type="hidden" name="loved_user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="amount_to_deduct" value="20">
                                        <button type="submit" class="btn btn-primary"  onclick="return validateWallet({{auth()->user()->wallet}})">
                                            <span style="font-size: 1.2rem;">&hearts;</span> Like
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                @endforeach
            </div>
        @endauth

        {{-- Waiting List --}}
        <h2 class="text-sm">
            Wait For Your Friend To Acc
        </h2>

        @auth
            <div class="row mt-4" id="userCards">
                {{-- @foreach($users as $user) --}}

                @php
                    if(auth()->user()->gender == 'male'){
                        $waiting = Matched::where('manid', '=', auth()->user()->id)->where('liked', '!=', auth()->user()->id)->where('state_id', '=', '2')->get();
                    }else{
                        $waiting = Matched::where('womanid', '=', auth()->user()->id)->where('liked', '!=', auth()->user()->id)->where('state_id', '=', '2')->get();
                    }
                @endphp

                @foreach ( $waiting as $wait)

                    @php
                        if(auth()->user()->gender == 'male'){
                            $waitmeUser = User::where('id', '=', $wait->womanid)->first();
                        } else{
                            $waitmeUser = User::where('id', '=', $wait->manid)->first();
                        }
                    @endphp

                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/'.$waitmeUser->photo) }}" class="card-img-top" alt="User Photo" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $waitmeUser->name }}</h5>
                                <p class="card-text">{{ $waitmeUser->job->jobName }}</p>
                                     <button type="button" class="btn btn-warning" >
                                    <span style="font-size: 1.2rem;">&hearts;</span> Waiting
                                </button>

                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- @endforeach --}}
            </div>
        @endauth


        {{-- Who Likes Me --}}
        <h2 class="text-sm">
            Someone Who Likes Me
        </h2>

        @auth
            <div class="row mt-4" id="userCards">
                {{-- @foreach($users as $user) --}}

                @php
                    $liker = Matched::where('liked', '=', auth()->user()->id)->where('state_id', '=', '2')->get();
                @endphp

                @foreach ( $liker as $like)

                    @php
                        if(auth()->user()->gender == 'male'){
                            $likemeUser = User::where('id', '=', $like->womanid)->first();
                        } else{
                            $likemeUser = User::where('id', '=', $like->manid)->first();
                        }
                    @endphp

                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/'.$likemeUser->photo) }}" class="card-img-top" alt="User Photo" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $likemeUser->name }}</h5>
                                <p class="card-text">{{ $likemeUser->job->jobName }}</p>

                                <form action="/matcher" method="POST">
                                    @csrf
                                    <input type="hidden" name="loved_user_id" value="{{ $like->id }}">
                                    <input type="hidden" name="amount_to_deduct" value="">
                                    <button type="submit" class="btn btn-primary"  onclick="return validateWallet({{auth()->user()->wallet}})">
                                        <span style="font-size: 1.2rem;">&hearts;</span> Like
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- @endforeach --}}
            </div>
        @endauth



            {{-- My Match --}}
            <h2 class="text-sm">
                My Friends Matchs
            </h2>

            @auth
                <div class="row mt-4" id="userCards">
                    {{-- @foreach($users as $user) --}}

                    @php
                        if(auth()->user()->gender == 'male'){
                            $lovers = Matched::where('manid', '=', auth()->user()->id)->where('state_id', '=', '3')->get();
                        } else{
                            $lovers = Matched::where('womanid', '=', auth()->user()->id)->where('state_id', '=', '3')->get();
                        }
                    @endphp

                    @foreach ( $lovers as $matchers)

                        @php
                            if(auth()->user()->gender == 'male'){
                                $matchUser = User::where('id', '=', $matchers->womanid)->first();
                            } else{
                                $matchUser = User::where('id', '=', $matchers->manid)->first();
                            }

                            // $linkedins= User::all();
                        @endphp

                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/'.$matchUser->photo) }}" class="card-img-top" alt="User Photo" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $matchUser->name }}</h5>
                                    <p class="card-text">{{ $matchUser->job->jobName }}</p>
                                    {{-- <p class="card-text">{{ $linkedins->linkedin }}</p> --}}
                                    @if ($matchUser->linkedin)
                                        <p class="card-text"><a href="{{ $matchUser->linkedin }}" target="_blank">LinkedIn</a></p>
                                    @endif

                                    <div class="container row d-flex justify-content-center ">

                                        <button type="button" class="btn btn-danger mb-1" >
                                            <span style="font-size: 1.2rem;">&hearts;</span> Friends
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- @endforeach --}}
                </div>
            @endauth

        {{-- @endauth --}}

</div>
@endsection
