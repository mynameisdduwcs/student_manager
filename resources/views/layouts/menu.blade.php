<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('students.index') }}" class="nav-link {{ Request::is('students') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Student</p>
    </a>

    <a href="{{ route('subjects.index') }}" class="nav-link {{ Request::is('subjects') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Subject</p>
    </a>

    <a href="{{ route('faculties.index') }}" class="nav-link {{ Request::is('faculties') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Faculty</p>
    </a>
</li>
