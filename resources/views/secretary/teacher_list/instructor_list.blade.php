@extends('layouts.app')

@section('content')

<div class="content-wrappers">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div >

    <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                    
                   
                </tr>
            </thead>

             <tbody>
              @foreach($instructors as $instructor)
                    <tr>
                       <td>{{ $instructor->name }} {{ $instructor->middle_name }} {{ $instructor->last_name }}</td>
                       
                     <td>  <a href="{{ route('secretary.teacher_list.subjects', ['instructorId' => $instructor->id]) }}"class="btn btn-info btn-sm">View Subjects</a></td>
                    </tr>
                
                @endforeach
            </tbody>
        </table>

  

</div>
</div>
</section>
</div>

@endsection

