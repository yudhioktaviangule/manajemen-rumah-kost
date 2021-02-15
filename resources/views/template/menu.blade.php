<li class="active"><a href="user"><i class="fa fa-link"></i> <span>User</span></a></li>
       
        <li class="treeview">
          <a href="#">
              <i class="fa fa-link"></i> 
              <span>Kamar</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Master Kamar</a></li>
            <li><a href="{{route('fasilitas.index')}}">Fasilitas</a></li>
            <li><a href="#">Perawatan </a></li>
          </ul>
        </li>
        <li><a href="penyewa"><i class="fa fa-link"></i> <span>Aset</span></a></li>
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