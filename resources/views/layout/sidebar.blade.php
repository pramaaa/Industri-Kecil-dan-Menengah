<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->


    <li class="nav-item">
      <a href="/listdata" class="nav-link {{ request()->is('listdata','form-input','industri/*','carikan','perkomoditi') ? 'active' : '' }}">
        <i class="nav-icon fas fa-edit"></i>
        <p>Data IKM</p>
      </a>
    </li>

    <li class="nav-item {{ request()->is('bobot','matriks_p','pilih_komoditi','perhitungan') ? 'menu-is-opening menu-open' : '' }}">
      <a href="#" class="nav-link {{ request()->is('bobot','matriks_p','pilih_komoditi','perhitungan') ? 'active' : '' }}">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
          Perhitungan
        </p>
      </a>

      <ul class="nav nav-treeview">

        <li class="nav-item">
          <a href="/bobot" class="nav-link {{ request()->is('bobot') ? 'active' : '' }}">
            <i class="fas fa-columns nav-icon"></i>
            <p>Bobot Kriteria</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/matriks_p" class="nav-link {{ request()->is('matriks_p') ? 'active' : '' }}">
            <i class="fas fa-th nav-icon"></i>
            <p>Matriks Perbandingan</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/pilih_komoditi" class="nav-link {{ request()->is('pilih_komoditi','perhitungan') ? 'active' : '' }}">
            <i class="far fa-chart-bar nav-icon"></i>
            <p>Menghitung Alternatif</p>
          </a>
        </li>

      </ul>
    </li>

    <li class="nav-item">
      <a href="/repass" class="nav-link {{ request()->is('repass') ? 'active' : '' }}">
        <span class="fa-passwd-reset fa-stack">
          <i class="fa fa-undo fa-stack-2x"></i>
          <i class="fa fa-lock fa-stack-1x"></i>
          </span> 
        <p>Ganti Password</p>
      </a>
    </li>

  </ul>
</nav>