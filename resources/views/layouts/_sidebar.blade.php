<div id="wrapper">
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
<div class="sidebar-brand-icon rotate-n-15">
</div>
<div class="sidebar-brand-text mx-3">Guidance Record</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">


<li class="nav-item">
<a class="nav-link" href="/home">
<span>Dashboard</span></a>
</li>





{{-- @if (auth()->user()->role === 'admin')
<!-- Divider -->
<hr class="sidebar-divider">
<li class="nav-item">
<a class="nav-link" href="/create-users">
<span>Create Users</span></a>
</li>
@endif --}}




{{-- admin  --}}

@if (auth()->user()->role === 'admin' || auth()->user()->role === 'counselor')
<!-- Divider -->
<hr class="sidebar-divider">
<li class="nav-item">
<a class="nav-link" href="/records">
<span>Records</span></a>
</li>
@endif




@if (auth()->user()->role === 'admin')
<!-- Divider -->
<hr class="sidebar-divider">
<li class="nav-item">
<a class="nav-link" href="/show-users">
<span>Users</span></a>
</li>
@endif


@if (auth()->user()->role === 'student')
<!-- Divider -->
<hr class="sidebar-divider">
<li class="nav-item">
<a class="nav-link" href="/history">
<span>History</span></a>
</li>
@endif


@if (auth()->user()->role === 'student' || auth()->user()->role === 'counselor')
<!-- Divider -->
<hr class="sidebar-divider">
<li class="nav-item">
<a class="nav-link" href="/user/change-password">
<span>Change Password</span></a>
</li>
@endif


</ul>

