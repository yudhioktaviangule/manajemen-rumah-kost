<li class=""><a href="{{route('home')}}"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
<li class=""><a href="{{route('m_aset.index')}}"><i class="fa fa-link"></i> <span>Aset</span></a></li>
  <li class='treeview'>
    <a href="penyewa">
      <i class="fa fa-link"></i>
      <span>Penyewa</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
        <li>
          <a href="{{ route('penyewa.index') }}">
              <i class="fa fa-link"></i> 
              <span>Penyewa</span>
          </a>
        </li>
        <li>
          <a href="{{ route('kamar_sewa.index') }}">
              <i class="fa fa-link"></i> 
              <span>Data Kamar Penyewa</span>
          </a>
        </li>
  </ul>
</li>
<li class="treeview">
  <a href="#">
      <i class="fa fa-link"></i> 
      <span>Kamar</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('kamar.index') }}">Master Kamar</a></li>
    <li><a href="{{route('fasilitas.index')}}">Fasilitas</a></li>

  </ul>
</li>
<li class="treeview">
  <a href="#">
      <i class="fa fa-link"></i> 
      <span>Keuangan</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
  <ul class="treeview-menu">
    <li class='treeview'>
        <a href="#">
          Pengeluaran
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('pemeliharaan.index')}}">Pemeliharaan Kamar</a></li>
          <li><a href="{{route('t_aset.index')}}">Penambahan Aset</a></li>
          <li><a href="{{ route('perawatan.index') }}">Perawatan Fasilitas Kamar</a></li>
        </ul>
    </li>
    <li><a href="{{route('pembayaran.index')}}">Pembayaran Sewa</a></li>
  </ul>
</li>

        