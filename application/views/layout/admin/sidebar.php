<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url(); ?>admin_dashboard">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-cog"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Thriftporium</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_dashboard' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - My Profile -->
    <li class="nav-item <?php echo ($this->uri->segment(2) == 'profile' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_profile">
            <i class="fas fa-fw fa-user"></i>
            <span>My Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Product
    </div>

    <!-- Nav Item - Product Collpapse -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_product' ? 'active' : ''); ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
            <i class="fas fa-tshirt"></i>
            <span>Product</span>
        </a>
        <div id="collapseProduct" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo site_url(); ?>admin_product">Product List</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>admin_product/add_product">Add Product</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Category Collpapse -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'category') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-bars"></i>
            <span>Category</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo site_url(); ?>category">Category List</a>
                <a class="collapse-item" href="<?php echo site_url(); ?>category/add_category">Add Category</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Order & Payment
    </div>

    <!-- Nav Item - Order -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_order' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_order">
            <i class="fas fa-shopping-basket"></i>
            <span>Order</span></a>
    </li>

    <!-- Nav Item - Payment -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'admin_payment' ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo site_url(); ?>admin_payment">
            <i class="fas fa-money-bill-wave"></i>
            <span>Payment</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->