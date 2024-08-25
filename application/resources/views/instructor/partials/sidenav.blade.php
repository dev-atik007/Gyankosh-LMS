@php
    $id = Auth::user()->id;
    $instructorId = App\Models\User::find($id);
    $status = $instructorId->status;
@endphp


<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('application/public/backend/assets/images/logo-icon.png') }}" class="logo-icon"
                alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->

    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('instructor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if ($status === '1')
            <li>
                <a href="{{ route('instructor.all.order') }}">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">All Orders</div>
                </a>
            </li>

            <li class="menu-label">Course Manage</li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Course Manage</div>
                </a>
                <ul>
                    <li> <a href="{{ route('instructor.course') }}"><i class='bx bx-radio-circle'></i>All Course</a>
                    </li>
                    <li> <a href="index2.html"><i class='bx bx-radio-circle'></i>Add Course</a>
                    </li>
                </ul>
            </li>
        @else
        @endif


    </ul>
    <!--end navigation-->
</div>
