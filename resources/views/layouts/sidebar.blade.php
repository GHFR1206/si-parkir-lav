<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">GHFRParkNet.Id</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->username }} 
                @role('admin') <small class="text-muted">(admin)</small>@endrole
                @role('petugas') <small class="text-muted">(petugas)</small>@endrole
              </a>
            </div>
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                   <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ?  'active' : '' }}">
                      <i class="nav-icon fas fa-solid fa-car"></i>
                      <p>
                        Data Kendaraan Aktif
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.data.selesai') }}" class="nav-link {{ request()->routeIs('admin.data.selesai') ?  'active' : '' }}">
                      <i class="nav-icon fas fa-solid fa-check"></i>
                      <p>
                        Data Kendaraan Selesai
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                   <a href="{{ route('admin.create') }}" class="nav-link {{ request()->routeIs('admin.create') ?  'active' : '' }}">
                     <i class="nav-icon fas fa-solid fa-plus"></i>
                     <p>
                       Tambah Data Parkir
                     </p>
                   </a>
                 </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
</div>