<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('application/public/backend/assets/images/logo-icon.png') }}" class="logo-icon"
                alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        {{-- dashboard --}}
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.all.course') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">All Course</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.instructor') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Instructor</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.all.coupon') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Manage Coupon</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.smtp.setting') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Manage SMTP</div>
            </a>
        </li>


        <li class="menu-label">UI Elements</li>

        {{-- category and subcategory --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-radio-circle'></i>
                </div>
                <div class="menu-title">Manage Category </div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.category') }}"><i class='bx bx-radio-circle'></i>All Category</a>
                </li>
                <li> <a href="{{ route('admin.all.sub.category') }}"><i class='bx bx-radio-circle'></i>All
                        Sub-Category</a>
                </li>
            </ul>
        </li>





        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-radio-circle'></i>
                </div>
                <div class="menu-title">Manage Order</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.pending.order') }}"><i class='bx bx-radio-circle'></i>Pending Orders</a>
                </li>
                <li> <a href="{{ route('admin.confirm.order') }}"><i class='bx bx-radio-circle'></i>Confirm Orders</a>
                </li>
            </ul>
        </li>



    </ul>
    <!--end navigation-->



</div>
