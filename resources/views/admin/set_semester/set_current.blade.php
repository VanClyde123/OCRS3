@extends('layouts.app')

@section('content')
    @push('scripts')
        <script>
            $(document).ready(function () {
                
                $('#semester_id').change(function () {
                    $('#currentSemesterForm').submit();
                });
            });
        </script>
    @endpush
    <div class="content-wrappers">
        <section class="content-header">
            <h2>Semesters</h2>
            <div  style="text-align: left;">
                <a href="{{ url('admin/set_semester/view_semesters')}}" class="btn btn-info">Modify Semesters</a>
            </div>
        </section>
        <section class="content">
            @include('messages')
            <div class="card ">
                <form method="post" action="{{ route('semesters.setupCurrent') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="semester_id">Current Semester:</label>
                            <select class="form-control" id="semester_id" name="semester_id" required>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}" {{ $semester->is_current ? 'selected' : '' }}>{{ $semester->semester_name }}, {{ $semester->school_year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Set as Current</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

