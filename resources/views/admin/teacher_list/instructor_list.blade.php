@extends('layouts.app')

@section('content')

@php
        $header_title = "Instructor List";
    @endphp

    <div class="content-wrappers">
        <section class="content-header">
            <h2><br></h2>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 1.75rem;">Instructor List</h3>
                    <div style="text-align: right;">
                          <a href="{{ url('admin/summary_report/reports') }}" class="btn btn-primary">Summary Report</a>
                        <a href="{{ route('grade-ceiling.edit') }}" class="btn  btn-success">Grade Ceiling Settings</a>
                         <button type="button" class="btn btn-success" data-toggle="modal" data-target="#finalStatusModal">
                            Manage Final Grade Options
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.searchInstructors') }}" method="GET" class="mb-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by Last Name, First Name or Middle Name">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($instructors->sortBy('name') as $instructor)
                                    <tr>
                                    <td>{{ $instructor->name }}</td>
                                    <td>{{ $instructor->middle_name }}</td>
                                    <td>{{ $instructor->last_name }}</td>
                                    <td>  
                                        <a href="{{ route('admin.teacher_list.subjects', ['instructorId' => $instructor->id]) }}"class="btn btn-info">View Current Courses</a> <a href="{{ route('admin.teacher_list.past_subjects', ['instructorId' => $instructor->id]) }}" class="btn btn-info">View Past Semester Courses</a>
                                       <a href="{{ route('admin.teacher_list.future_subjects', ['instructorId' => $instructor->id]) }}" class="btn btn-info">Set Next Semester Courses</a>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>


   <!-- Final Status Settings Modal -->
    <div class="modal fade" id="finalStatusModal" tabindex="-1" role="dialog" aria-labelledby="finalStatusModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Final Status Options</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          <div class="modal-body">
            <form id="finalStatusForm">
              @csrf
              <div class="form-group">
                <label for="statusName">Add New Options</label>
                <input type="text" class="form-control" id="statusName" name="name" required>
              </div>
              <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
            <hr>
            <h6>Options:</h6>
            <ul id="statusList" class="list-group">
            </ul>
          </div>
        </div>
      </div>
</div>

<script>
    $(document).ready(function () {
        
        $('#finalStatusModal').on('show.bs.modal', function () {
            fetchStatuses();
        });

       
        $('#finalStatusForm').submit(function (e) {
            e.preventDefault();
            const statusName = $('#statusName').val();
            const token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ route('final-status.store') }}",
                method: "POST",
                data: {
                    _token: token,
                    name: statusName
                },
                success: function (response) {
                    $('#statusName').val('');
                    fetchStatuses(); // Reload list
                },
                error: function (xhr) {
                    alert(xhr.responseJSON.message || 'Failed to add status');
                }
            });
        });

       function fetchStatuses() {
            $.ajax({
                url: "{{ route('final-status.index') }}",
                method: "GET",
                success: function (statuses) {
                    let list = '';
                    statuses.forEach(status => {
                        list += `
                            <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${status.id}">
                                <span class="status-name">${status.name}</span>
                                <div class="status-actions">
                                    <button class="btn btn-sm btn-outline-secondary edit-status">Edit</button>
                                </div>
                            </li>
                        `;
                    });
                    $('#statusList').html(list);
                }
            });
        }

        
    $('#statusList').on('click', '.edit-status', function () {
        const listItem = $(this).closest('li');
        const currentName = listItem.find('.status-name').text();
        const id = listItem.data('id');

        listItem.html(`
           <div class="d-flex flex-column">
                <input type="text" class="form-control form-control-sm status-edit-input mb-2" value="${currentName}">
                <div class="d-flex">
                    <button class="btn btn-sm btn-success save-status mr-2" data-id="${id}">Save</button>
                    <button class="btn btn-sm btn-secondary cancel-edit">Cancel</button>
                </div>
            </div>
        `);
    });

    
    $('#statusList').on('click', '.cancel-edit', function () {
        fetchStatuses();
    });

    
    $('#statusList').on('click', '.save-status', function () {
        const id = $(this).data('id');
        const newName = $(this).closest('li').find('.status-edit-input').val();
        const token = $('input[name="_token"]').val();

        $.ajax({
           url: "{{ url('/admin/final-status-options') }}/" + id,
            method: 'PUT',
            data: {
                _token: token,
                name: newName
            },
            success: function () {
                fetchStatuses();
            },
            error: function (xhr) {
                alert(xhr.responseJSON.message || 'Error saving changes');
            }
        });
    });
    });
</script>
@endsection

