@php
    $level = Auth::user()->level;
@endphp

@if($level==='admin'||$level==='karyawan')
    @include('halaman.home.admin')
@else
    @include('halaman.home.penyewa')
@endif