<div id="mySidebar" class="sidebars">
  
    {{-- DO NOT TOUCH --}}
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li>
                @php
                    $roles = [
                        1 => 'Admin',
                        2 => 'Instructor',
                        3 => 'Student',
                        4 => 'Secretary',
                    ];
                        $currentSemester = \App\Models\Semester::where('is_current', 1)->first();
                        $currentSemesterText = $currentSemester ? $currentSemester->semester_name . ', ' . $currentSemester->school_year : 'No current semester';
                @endphp

                <div>
                    @if (Auth::check() && Auth::user()->role != 3) {{-- 3 = Student --}}
                            
                                <div>
                                    <a class="nav-link" style="color:white; font-size: 80%;">
                                        {{ $currentSemesterText }}
                                    </a>
                                </div>
                            
                        @endif
                   <div>
                   <a href="{{ route('user.profile') }}" class="nav-link clickable-name" style="color:white;">
                        {{ Auth::user()->name }} {{ Auth::user()->last_name }}
                    </a>
                        <a class="nav-link" style="color:white; font-size: 90%;">
                            {{ $roles[Auth::user()->role] }}
                                  @if (Auth::user()->secondary_role)
                                    | {{ $roles[Auth::user()->secondary_role] }}
                                  @endif
                                        
                        </a>
                        <hr>
                       
                    </div>

                </div>
            </li>
            @if (Auth::user()->password_changed== 0) 
                {{--Hide buttons--}}
            @else 
                <div id="headbutts">
                   @if(Auth::user()->role == 1)
                        <li class="nav-item">
                            <a href="{{ url('admin/admin/list')}}" class="nav-link @if (Request::segment(3) == 'list') active @elseif (Request::segment(3) == 'view_students') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'add') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'student_list') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'confirm-password') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'edit') active @endif">
                                <p>Main User List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/set_semester/set_current')}}" class="nav-link @if (Request::segment(1) == 'admin' && Request::segment(3) == 'set_current') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'view_semesters') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'semesters') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'semesters') active @endif">
                                <p>Semester</p>
                            </a>
                        </li>
    
                        <li class="nav-item">
                            <a href="{{ url('admin/teacher_list/instructor_list')}}" class="nav-link 
                            @if (Request::segment(1) == 'admin' && Request::segment(2) == 'teacher_list') active @elseif (Request::segment(1) == 'admin' && Request::segment(4) == 'subjects') active @elseif (Request::segment(1) == 'admin' && Request::segment(4) == 'past_subjects') active @elseif (Request::segment(1) == 'admin' && Request::segment(4) == 'students') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'view-student-points') active @endif"> 
                                <p>Instructor List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/subject_list/view_subjects')}}" class="nav-link @if (Request::segment(1) == 'admin' && Request::segment(3) == 'view_subjects') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'subject_list') active @endif">
                                <p>Change Instructor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/subject_types/viewtypes')}}" class="nav-link  @if (Request::segment(1) == 'admin' && Request::segment(2) == 'subject_types') active  @endif">
                                <p>Class Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/subject_descriptions')}}" class="nav-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'subject_descriptions') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'assessment_description') active @elseif (Request::segment(1) == 'assessment-descriptions') active @elseif (Request::segment(1) == 'sections') active @endif">
                                <p>Course Maintenance</p>
                            </a>
                        </li>

                @if (Auth::user()->secondary_role == 2)
                    <li class="nav-item">
                    <a href="{{ url('teacher/list/classlist')}}"  class="nav-link @if (Request::segment(1) == 'teacher' && Request::segment(3) == 'studentlist') active @elseif (Request::segment(1) == 'teacher' && Request::segment(3) == 'past_classlist') active @elseif (Request::segment(1) == 'teacher' && Request::segment(3) == 'classlist') active  @elseif (Request::segment(1) == 'studentlistremove') active @elseif (Request::segment(1) == 'assessments') active @endif">
                    <p>
                        Course List
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('teacher/list/importexcel')}}" class="nav-link @if (Request::segment(3) == 'importexcel') active @elseif (Request::segment(3) == 'imported-data') active @elseif (Request::segment(1) == 'save-data') active @endif">
                        <p>Import </p>
                    </a>
                </li>
                @endif
               

            @elseif(Auth::user()->role == 2)
                @if (Auth::user()->secondary_role == 1)
                    
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#collapse1">  Admin Pages -</a>
                        
                        <div id="collapse1" class="panel-collapse ">
                            <ul class="list-group">
                                <li class="nav-item">
                                    <a href="{{ url('admin/admin/list')}}" class="nav-link @if (Request::segment(3) == 'list') active @elseif (Request::segment(3) == 'view_students') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'add') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'student_list') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'confirm-password') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'edit') active @endif">
                                        <p>Main User List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/set_semester/set_current')}}" class="nav-link @if (Request::segment(1) == 'admin' && Request::segment(3) == 'set_current') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'view_semesters') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'semesters') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'semesters') active @endif">
                                        <p>Semester</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/teacher_list/instructor_list')}}" class="nav-link 
                                    @if (Request::segment(1) == 'admin' && Request::segment(2) == 'teacher_list') active @elseif (Request::segment(1) == 'admin' && Request::segment(4) == 'subjects') active @elseif (Request::segment(1) == 'admin' && Request::segment(4) == 'past_subjects') active @elseif (Request::segment(1) == 'admin' && Request::segment(4) == 'students') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'view-student-points') active @endif"> 
                                        <p>Instructor List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/subject_list/view_subjects')}}" class="nav-link @if (Request::segment(1) == 'admin' && Request::segment(3) == 'view_subjects') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'subject_list') active @endif">
                                        <p>Change Instructor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/subject_types/viewtypes')}}" class="nav-link  @if (Request::segment(1) == 'admin' && Request::segment(2) == 'subject_types') active  @endif">
                                        <p>Class Types</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/subject_descriptions')}}" class="nav-link @if (Request::segment(1) == 'admin' && Request::segment(2) == 'subject_descriptions') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'assessment_description') active @elseif (Request::segment(1) == 'assessment-descriptions') active @elseif (Request::segment(1) == 'sections') active  @endif">
                                        <p>Course Maintenance</p>
                                    </a>
                                </li>
                            </ul>
                        </div>   
                    </li>
                @endif
                <hr>
                <li class="nav-item">
                    <a href="{{ url('teacher/list/classlist')}}"  class="nav-link @if (Request::segment(1) == 'teacher' && Request::segment(3) == 'studentlist') active @elseif (Request::segment(1) == 'teacher' && Request::segment(3) == 'past_classlist') active @elseif (Request::segment(1) == 'teacher' && Request::segment(3) == 'classlist') active  @elseif (Request::segment(1) == 'studentlistremove') active @elseif (Request::segment(1) == 'assessments') active @endif">
                    <p>
                        Course List
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('teacher/list/importexcel')}}" class="nav-link @if (Request::segment(3) == 'importexcel') active @elseif (Request::segment(3) == 'imported-data') active @elseif (Request::segment(1) == 'save-data') active @endif">
                        <p>Import </p>
                    </a>
                </li>
                 

            @elseif(Auth::user()->role == 3)
                <li class="nav-item">
                    <a  href="{{ url('student/subjectlist', ['studentId' => Auth::user()->id]) }}" class="nav-link @if (Request::segment(2) == 'subjectlist') active @elseif (Request::segment(1) == 'student') active @elseif (Request::segment(1) == 'sections') active  @endif">
                        <p>Course List</p>
                    </a>
                </li>
                 
            @elseif(Auth::user()->role == 4)
                @if (Auth::user()->secondary_role == 1)
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#collapse1">  Admin Pages -</a>
                        
                        <div id="collapse1" class="panel-collapse ">
                        <ul class="list-group">
                            <li class="nav-item">
                                <a href="{{ url('admin/admin/list')}}" class="nav-link @if (Request::segment(1) == 'admin' && Request::segment(3) == 'add') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'admin') active @elseif (Request::segment(1) == 'admin' && Request::segment(2) == 'student_list') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'confirm-password') active @elseif (Request::segment(1) == 'admin' && Request::segment(3) == 'edit') active @endif">
                                    <p>Main User List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <hr>
                <li class="nav-item">
                    <a href="{{ url('secretary/teacher_list/instructor_list')}}" class="nav-link @if (Request::segment(1) == 'secretary' && Request::segment(3) == 'instructor_list') active @elseif (Request::segment(1) == 'secretary' && Request::segment(2) == 'teacher_list') active @elseif (Request::segment(1) == 'view-student-points') active @endif">
                        <p>Instructor List</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ url('secretary/student_list/view_students')}}" class="nav-link @if (Request::segment(1) == 'secretary' && Request::segment(2) == 'student_list') active @endif">
                        <p>Student List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('secretary/set_semester/set_current')}}" class="nav-link @if (Request::segment(3) == 'set_current') active @endif">
                        <p>Semester</p>
                    </a>
                </li>
                 
                  <li class="nav-item">
                    <a href="{{ url('secretary/subject_descriptions')}}" class="nav-link @if (Request::segment(3) == 'view_subject_desc') active @elseif (Request::segment(1) == 'secretary' && Request::segment(2) == 'subject_descriptions') active  @elseif (Request::segment(1) == 'secretary' && Request::segment(2) == 'assessment_description') active @elseif (Request::segment(1) == 'sections') active  @endif">
                        <p>Course Maintenance</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('secretary/subject_types/viewtypes')}}" class="nav-link @if (Request::segment(3) == 'viewtypes') active @endif">
                        <p>Class Types</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ url('secretary/subject_list/view_subjects')}}" class="nav-link @if (Request::segment(3) == 'view_subjects') active @elseif (Request::segment(2) == 'subject_list' && Request::segment(3) == 'changeInstructor') active @endif">
                        <p>Change Instructor</p>
                    </a>
                </li>
                
                  
            @endif
                </div>
            @endif
            <li class="nav-item">
                <a href="{{ url('logout')}}" class="nav-link">
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
    {{-- DO NOT TOUCH --}}
</div>

<div id="butt" class="butt">
    <button id="openbtn" class="openbtn" onclick="openNav()"> ☰ </button>
</div>

<style>
    .clickable-name {
    color: white; 
    text-decoration: none; 
    cursor: pointer;
    }

    .clickable-name:hover {
        text-decoration: underline; 
        color: lightblue; 
    }
</style>

<script>
    const openBtn = document.getElementById('openbtn'); 
    const closeBtn = document.getElementById('closebtn');

    const mediaQuery = window.matchMedia('(max-width: 768px)');
    if(mediaQuery.matches) {
        closeNav();
    }
    mediaQuery.addEventListener('change', event => {
        if(event.matches) {
            closeNav();
        } else {
            openNav();
        }
    });
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById("closebtn").style.display = "block";
        document.getElementById("openbtn").style.display = "none";
        document.getElementById("mySidebar").style.width = "200px";
        document.getElementById("main").style.marginLeft = "200px"; 
    });
    function openNav() {
        document.getElementById("closebtn").style.display = "block";
        document.getElementById("openbtn").style.display = "none";
        document.getElementById("mySidebar").style.width = "200px";
        document.getElementById("main").style.marginLeft= "200px";
    }
    function closeNav() {
        document.getElementById("closebtn").style.display = "none";
        document.getElementById("openbtn").style.display = "block";
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
    }
</script>