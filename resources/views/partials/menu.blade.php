<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">
    <ul class="c-sidebar-nav">
        <div class="c-sidebar-brand d-md-down-none">
            <a class="c-sidebar-brand-full h4" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="" width="100" alt="">
            </a>
        </div>

        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.home') }}" class="c-sidebar-nav-link" target="">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>

        @if (auth()->user()->role != 'employee')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.departments.index') }}" class="c-sidebar-nav-link" target="">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>
                    Departments
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.employees.index') }}" class="c-sidebar-nav-link" target="">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>
                    Employees
                </a>
            </li>
        @endif
       
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.tasks.index') }}" class="c-sidebar-nav-link" target="">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>
                Tasks
            </a>
        </li>
    </ul>
</div>
