@php
      $data = \App\Models\User::where('aktif','nonaktif')->count();
      $stash = $data == 0 ? "":"
          <span class='right badge badge-primary'>
                $data
          </span>
      ";
  @endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('lte3/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class='nav-link' href="{{route('home')}}">
                        <i class="fas fa-tachometer-alt nav-icon"></i> 
                        <p>Beranda</p>
                    </a>
                </li>
                @if(Auth::user()->level==='admin'||Auth::user()->level==='karyawan')
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Data Master <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(Auth::user()->level==='admin')
                                <li class="nav-item">
                                    <a class='nav-link' href="{{ route('user.index') }}">
                                        <i class="far fa-circle nav-icon"></i> 
                                        <p>Data Karyawan</p>
                                    </a>
                                </li>
                            @endif
                                <li class="nav-item">
                                    <a class='nav-link' href="{{route('m_aset.index')}}">
                                        <i class="far fa-circle nav-icon"></i> 
                                        <p>Aset</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class='nav-link' href="{{ route('kamar.index') }}">
                                        <i class="fas fa-bed nav-icon"></i> 
                                        <p>Kamar</p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class='nav-link' href="{{ route('penyewa.index') }}">
                            <i class="fas fa-address-card nav-icon"></i> <p>Penghuni{!! $stash !!}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class='nav-link' href="{{ route('pengeluaran.index') }}">
                            <i class="fas fa-credit-card nav-icon"></i> 
                            <p>Pengeluaran</p>
                        </a>
                    </li>

                    @if(Auth::user()->level==='admin')
                        <li class="nav-item">
                            <a class='nav-link' href="{{ route('laporan.index') }}">
                                <i class="far fa-file nav-icon"></i> 
                                <p>Laporan</p>
                            </a>
                        </li>
                    @endif
                @endif
                <li class="nav-item">
                        <a class='nav-link' href="#" onclick="logot()">
                            <i class="fas fa-sign-out-alt nav-icon"></i> 
                            <p>Logout</p>
                        </a>
                    </li>


            </ul>
        </nav>
    </div>
</aside>