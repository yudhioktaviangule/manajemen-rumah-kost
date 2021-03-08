<li class=""><a href="{{route('home')}}"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
@if(Auth::user()->level==='admin')
  <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> <span>Manajemen User</span></a></li>
@endif
@if(Auth::user()->level==='admin'||Auth::user()->level==='karyawan')
  <li class=""><a href="{{ route('penyewa.index') }}"><i class="fa fa-address-card"></i> <span>Penghuni</span></a></li>
  <li class=""><a href="{{route('m_aset.index')}}"><i class="fa fa-circle-o"></i> <span>Aset</span></a></li>
  <li class=""><a href="{{ route('kamar.index') }}"><i class="fa fa-bed"></i> <span>Kamar</span></a></li>
  <li class=""><a href="{{ route('pengeluaran.index') }}"><i class="fa fa-credit-card"></i> <span>Pengeluaran</span></a></li>
@else
  <li class=""><a href="#"><i class="fa fa-link"></i> <span>Pembayaranku</span></a></li>
@endif
@if(Auth::user()->level==='admin')
  <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-file-o"></i> <span>Laporan</span></a></li>
@endif


        