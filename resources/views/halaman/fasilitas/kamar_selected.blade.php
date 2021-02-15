@extends('template.index')

@section('judul','Fasilitas Kamar')
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">No Kamar : {{$data->nomor}}</h3>
            <div class="box-tools">
                <a href="{{ route('fasilitas.create') }}?id={{$data->id}}" class="btn btn-primary">
                    TAMBAH FASILITAS
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fasilitas</th>
                            <th>Keterangan</th>
                            <th>#</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach($fasilitas as $key => $value)
                            <tr>
                                <td>
                                    {{$value->getAset()->aset}}
                                </td>
                                <td>{{$value->keterangan}}</td>
                                <td>
                                    <a href="#" onclick="del({{$value->id}})" class="btn btn-danger btn-xs btn-block">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="{{route('fasilitas.index')}}/" id='del' method="POST">
                    @csrf
                    <input type='hidden' name='_method' value='delete'/>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("jscript")
    <script>
        $(document).ready(()=>{
            window.del =(id)=>{
                let conf = confirm("Ingin Menghapus data?");
                if(conf){
                    let act = $("#del").attr("action");
                    act+=id;
                    $("#del").attr('action',act);
                    $("#del").submit();
                }
            }
        });
    </script>
@endsection