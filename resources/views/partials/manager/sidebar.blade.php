<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('atlantis') }}/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ auth()->user()->name }}
                            <span class="user-level">Manager</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-warning">
                <li class="nav-item {{ Route::is('manager.dashboard') ? 'active':'' }}">
                    <a href="{{ url('manager') }}" >
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section ">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master Data</h4>
                </li>
                <li class="nav-item {{ Route::is('manager.produk*') ? 'active':'' }}">
                    <a href="{{ url('manager/produk') }}">
                        <i class="fas fa-file-contract"></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('manager.perusahaan*') ? 'active':'' }}">
                    <a href="{{ url('manager/perusahaan') }}">
                        <i class="far fa-building"></i>
                        <p>Perusahaan</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('manager.karyawan*') ? 'active':'' }}">
                    <a href="{{ url('manager/karyawan') }}">
                        <i class="fas fa-users"></i>
                        <p>Karyawan</p>
                    </a>
                </li>
                <li class="nav-section ">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Quotation</h4>
                </li>
                <li class="nav-item {{ Route::is('manager.quotation.draft*') ? 'active':'' }}">
                    <a href="{{ url('manager/quotation-draft') }}">
                        <i class="fas fa-file-contract"></i>
                        <p>Draft Quotation</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('manager.quotation.confirmed*') ? 'active':'' }}">
                    <a href="{{ url('manager/quotation-confirmed') }}">
                        <i class="far fa-building"></i>
                        <p>Confirmed Quotation</p>
                    </a>
                </li>
                <li class="nav-section ">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Invoice</h4>
                </li>
                <li class="nav-item {{ Route::is('manager.invoice.draft*') ? 'active':'' }}">
                    <a href="{{ url('manager/invoice-draft') }}">
                        <i class="fas fa-file-contract"></i>
                        <p>Draft Invoice</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('manager.invoice.confirmed*') ? 'active':'' }}">
                    <a href="{{ url('manager/invoice-confirmed') }}">
                        <i class="far fa-building"></i>
                        <p>Confirmed Invoice</p>
                    </a>
                </li>
                <li class="nav-section ">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Delivery</h4>
                </li>
                <li class="nav-item {{ Route::is('manager.delivery.draft*') ? 'active':'' }}">
                    <a href="{{ url('manager/delivery-draft') }}">
                        <i class="fas fa-file-contract"></i>
                        <p>Draft Delivery</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('manager.delivery.confirmed*') ? 'active':'' }}">
                    <a href="{{ url('manager/delivery-confirmed') }}">
                        <i class="far fa-building"></i>
                        <p>Confirmed Delivery</p>
                    </a>
                </li>
                <li class="nav-section ">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Project</h4>
                </li>
                <li class="nav-item {{ Route::is('manager.project.ongoing*') ? 'active':'' }}">
                    <a href="{{ url('manager/project-ongoing') }}">
                        <i class="fas fa-file-contract"></i>
                        <p>Ongoing Project</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('manager.project.done*') ? 'active':'' }}">
                    <a href="{{ url('manager/project-done') }}">
                        <i class="far fa-building"></i>
                        <p>Done Project</p>
                    </a>
                </li>

                <li class="nav-section ">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Configure</h4>
                </li>
                <li class="nav-item {{ route::is('manager.cv') ? 'active':'' }}">
                    <a href="{{ url('manager/cv') }}">
                        <i class="fas fa-building"></i>
                        <p>Company Profile</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
