<div id="mySidebar" class="sidebars">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    {{-- DO NOT TOUCH --}}
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li>
                <div>
                    <div >
                        <a class="nav-link" style="color:white;">{{ Auth::user()->name }}</a><hr>
                    </div>
                </div>
            </li>
            @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a href="{{ url('admin/admin/list')}}" class="nav-link @if (Request::segment(2) == 'admin' && Request::segment(3) == 'list') active @elseif (Request::segment(2) == 'admin' && Request::segment(3) == 'add') active @elseif (Request::segment(2) == 'admin' && Request::segment(3) == 'edit') active @elseif (Request::segment(3) == 'confirm-password') active @elseif (Request::segment(3) == 'view_students') active @endif">
                        <p>User List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/subject_types/viewtypes')}}" class="nav-link @if (Request::segment(3) == 'viewtypes') active @endif">
                        <p>Class Types</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/assessment_description/view_desc')}}" class="nav-link @if (Request::segment(3) == 'view_desc') active @elseif (Request::segment(1) == 'assessment-descriptions' && Request::segment(2) == 'create') active @elseif (Request::segment(1) == 'assessment-descriptions' && Request::segment(3) == 'edit') active @endif">
                        <p>Assessment Descriptions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/set_semester/set_current')}}" class="nav-link @if (Request::segment(3) == 'set_current') active @elseif (Request::segment(2) == 'set_semester' && Request::segment(3) == 'view_semesters') active @elseif (Request::segment(2) == 'semesters' && Request::segment(3) == 'create') active @elseif (Request::segment(2) == 'semesters' && Request::segment(4) == 'edit') active @endif">
                        <p>Semester</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/subject_list/view_subjects')}}" class="nav-link @if (Request::segment(3) == 'view_subjects') active @elseif (Request::segment(3) == 'changeInstructor') active @endif">
                        <p>Subject List</p>
                    </a>
                </li>
            
            @elseif(Auth::user()->role == 2)
                <li class="nav-item">
                    <a href="{{ url('teacher/list/classlist')}}"  class="nav-link @if (Request::segment(3) == 'classlist') active @elseif (Request::segment(3) == 'past_classlist') active @elseif (Request::segment(3) == 'studentlist') active @elseif (Request::segment(1) == 'assessments') active @endif"> 
                    <p>
                        Subject List
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('teacher/list/importexcel')}}" class="nav-link @if (Request::segment(4) == 'importexcel') active @endif">
                        <p>Import </p>
                    </a>
                </li>

            @elseif(Auth::user()->role == 3)
                <li class="nav-item">
                    <a  href="{{ url('student/subjectlist', ['studentId' => Auth::user()->id]) }}" class="nav-link @if (Request::segment(3) == 'subjectlist') active @endif">
                        <p>Subjects</p>
                    </a>
                </li>
            @elseif(Auth::user()->role == 4)
                <li class="nav-item">
                    <a href="{{ url('secretary/teacher_list/instructor_list')}}" class="nav-link @if (Request::segment(3) == 'instructor_list') active @endif">
                        <p>Instructors</p>
                    </a>
                </li>
                  <li class="nav-item">
                    <a href="{{ url('secretary/assessment_description/view_desc')}}" class="nav-link @if (Request::segment(3) == 'view_desc') active @endif">
                        <p>Assessment Descriptions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('secretary/subject_types/viewtypes')}}" class="nav-link @if (Request::segment(3) == 'viewtypes') active @endif">
                        <p>Class Types</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('secretary/set_semester/set_current')}}" class="nav-link @if (Request::segment(3) == 'set_current') active @endif">
                        <p>Semester</p>
                    </a>
                </li>

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
    <button class="openbtn" onclick="openNav()"> ☰ </button>
</div>

<script>
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
        document.getElementById("mySidebar").style.width = "200px";
        document.getElementById("butt").style.display = "none";
        document.getElementById("main").style.marginLeft = "200px"; 
    });
    function openNav() {
        document.getElementById("mySidebar").style.width = "200px";
        document.getElementById("main").style.marginLeft= "200px";
        document.getElementById("butt").style.display = "none";
    }
    function closeNav() {
        document.getElementById("butt").style.display = "block";
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
    }
</script>