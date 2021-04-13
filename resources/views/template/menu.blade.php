<li class=""><a href="{{route('home')}}"><i class="fa fa-link"></i> <span>Beranda</span></a></li>
@if(Auth::user()->level==='admin'||Auth::user()->level==='karyawan')
  @php
      $data = \App\Models\User::where('aktif','nonaktif')->count();
      $stash = $data == 0 ? "":"
          <span class='pull-right'>
              <span class='badge badge-danger'>
                  $data
              </span>
          </span>
      ";
  @endphp
  
  <li class="treeview">
    <a href="#">
      <i class="fa fa-circle-o"></i> Master
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      @if(Auth::user()->level==='admin')
        <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> <span>Data Karyawan</span></a></li>
      @endif
      <li class=""><a href="{{route('m_aset.index')}}"><i class="fa fa-circle-o"></i> <span>Aset</span></a></li>
      <li class=""><a href="{{ route('kamar.index') }}"><i class="fa fa-bed"></i> <span>Kamar</span></a></li>  
    </ul>
  </li>
  <li class=""><a href="{{ route('penyewa.index') }}"><i class="fa fa-address-card"></i> <span>Penghuni{!! $stash !!}</a></li>
  <li class=""><a href="{{ route('pengeluaran.index') }}"><i class="fa fa-credit-card"></i> <span>Pengeluaran</span></a></li>
@endif
@if(Auth::user()->level==='admin')
  <li class=""><a href="{{ route('laporan.index') }}"><i class="fa fa-file-o"></i> <span>Laporan</span></a></li>
@endif


        