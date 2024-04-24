<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title text-uppercase">Main</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.list') }}" class="waves-effect">
                        <i class="fas fa-hard-hat"></i>
                        <span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('product.list') }}" class="waves-effect">
                        <i class="fab fa-shopify"></i>
                        <span>Product</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('coupon.list') }}" class="waves-effect">
                        <i class="fas fa-bacon"></i>
                        <span>Coupon</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="fas fa-band-aid"></i>
                        <span>Order</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="waves-effect">
                        <i class="fas fa-user"></i>
                        <span>Customer</span>
                    </a>
                </li>
               
                <li>
                    <a href="#" class="has-arrow waves-effect">
                        <i class="fas fa-chevron-circle-right"></i>
                        <span> Reports </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="#" class="waves-effect">
                                <i class="far fa-calendar-check"></i>
                                <span>Datewise Sale</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="waves-effect">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Sale Summary</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="has-arrow waves-effect">
                        <i class="dripicons-gear font-size-16 align-middle me-1"></i>
                        <span> Settings </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('profile.list') }}" class="waves-effect">
                                <i class="fas fa-user-check"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('permission.list') }}" class="waves-effect">
                                <i class="fas fa-check-double"></i>
                                <span>Permission</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
