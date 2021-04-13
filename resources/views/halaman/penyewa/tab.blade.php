<ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Informasi Umum</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">Informasi Kamar</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu2">Informasi Contact Keluarga</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane container active" id="home">
        <div class="container-fluid">
            @include("halaman.penyewa.sub.umum")
        </div>
    </div>
    <div class="tab-pane container fade" id="menu1">
        <div class="container-fluid">
            @include("halaman.penyewa.sub.kamar")
        </div>
    </div>
    <div class="tab-pane container fade" id="menu2">
        <div class="container-fluid">
            @include("halaman.penyewa.sub.keluarga")
        </div>
    </div>
</div>