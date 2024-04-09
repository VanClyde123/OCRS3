@extends('layouts.app') 

@section('content')
<div class="content-wrappers">
    <section class="content-header">
        <h2>Confirm Password</h2>
    </section>
    <!-- Main content -->
    <section class="content">
            @include('messages')
            <div class="card ">
                <form method="post" action="{{ route('admin.confirm-password', ['id' => $userId]) }}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                                <label for="password">Enter your password to proceed:</label>
                                <input type="password" name="password" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
    </section>
</div>
@endsection

 