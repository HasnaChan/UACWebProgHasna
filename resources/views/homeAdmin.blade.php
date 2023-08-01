@extends('layout.masterAdmin')

@section('homeAdmin')
@section('content')

<div class="container mx-auto">
    @auth
    <div class="mt-5">
        <h3>Show All User</h3>
    </div>

    <div class="row">
        @foreach ($user as $u)
            @if ($u->state_id != 4)
            <div class="col-md-3 mt-4">
                <div class="card">
                    <img src="{{ asset('storage/'.$u->photo) }}" class="card-img-top" alt="User Photo" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $u->name }}</h5>
                        <p class="card-text">{{ $u->job->jobName }}</p>

                        <form action="/ban-user/{{ $u->id }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                Ban User
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @endif

        @endforeach
    </div>



    <div class="row">
        @foreach ($user as $u)
            @if ($u->state_id == 4)
            <div class="mt-5">
                <h3>Banned user</h3>
            </div>
                <div class="col-md-3 mt-4">
                    <div class="card">
                        <img src="{{ asset('storage/'.$u->photo) }}" class="card-img-top" alt="User Photo" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $u->name }}</h5>
                            <p class="card-text">{{ $u->city->cityName }}</p>

                            <form action="/unban-user/{{ $u->id }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    Un-ban User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>




    @endauth

@endsection
