<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url('') }}/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->nama_lengkap }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="header">MASTER</li>
            <li class="{{ Route::currentRouteName() == 'karyawan.index' ? 'active' : '' }}">
                <a href="{{ route('karyawan.index') }}">
                    <i class="fa fa-users"></i> <span>Karyawan</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'jabatan.index' ? 'active' : '' }}">
                <a href="{{ route('jabatan.index') }}">
                    <i class="fa fa-graduation-cap"></i> <span>Jabatan</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'kalender.index' ? 'active' : '' }}">
                <a href="{{ route('kalender.index') }}">
                    <i class="fa fa-calendar"></i> <span>Kalender</span>
                </a>
            </li>
            <li class="header">ABSENSI</li>
            <li class="{{ Route::currentRouteName() == 'kehadiran.index' ? 'active' : '' }}">
                <a href="{{ route('kehadiran.index') }}">
                    <i class="fa fa-exchange"></i> <span>Kehadiran</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-newspaper-o"></i> <span>Ajuan Karyawan</span>
                </a>
            </li>
            <li class="header">REPORT</li>
            <li>
                <a href="">
                    <i class="fa fa-pie-chart"></i> <span>Kehadiran</span>
                </a>
            </li>
            <li class="header">SETTINGS</li>
            <li>
                <a href="">
                    <i class="fa fa-qrcode"></i> <span>Absensi</span>
                </a>
                <a href="">
                    <i class="fa fa-credit-card"></i> <span>Profile</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
