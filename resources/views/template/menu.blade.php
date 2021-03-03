<li class=""><a href="{{route('home')}}"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
@if(Auth::user()->level==='admin')
  <li class=""><a href="{{ route('penyewa.index') }}"><i class="fa fa-link"></i> <span>Penyewa</span></a></li>
  <li class=""><a href="{{ route('kamar.index') }}"><i class="fa fa-link"></i> <span>Kamar</span></a></li>
  <li class=""><a href="{{route('m_aset.index')}}"><i class="fa fa-link"></i> <span>Aset</span></a></li>
@endif


        