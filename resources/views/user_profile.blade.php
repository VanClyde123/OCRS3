@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @include('messages')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header text-center">Profile</div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4>
                            {{ $user->name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @if ($user->middle_name)
                                {{ $user->middle_name }}.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                            {{ $user->last_name }}
                        </h4>
                        
                    </div>
                    <div class="text-center mb-4">
                        <h5>
                            @php
                                $roles = [
                                    1 => 'Admin',
                                    2 => 'Instructor',
                                    3 => 'Student',
                                    4 => 'Secretary',
                                ];
                            @endphp
                            {{ $roles[$user->role] }}
                            @if ($user->secondary_role)
                                | {{ $roles[$user->secondary_role] }}
                            @endif
                        </h5>
                    </div>
                    <div class="text-center">
                        @if(Auth::user()->role == 1)
                            <a href="{{ route('change-password') }}" class="btn btn-primary">Change Password</a>
                        @elseif(Auth::user()->role == 2)
                            <a href="{{ route('change-password2') }}" class="btn btn-primary">Change Password</a>
                        @elseif(Auth::user()->role == 3)
                            <a href="{{ route('change-password3') }}" class="btn btn-primary">Change Password</a>
                        @elseif(Auth::user()->role == 4)
                            <a href="{{ route('change-password1') }}" class="btn btn-primary">Change Password</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
