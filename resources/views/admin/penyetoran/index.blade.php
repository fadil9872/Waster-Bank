@extends('admin.layouts.dashboard')
@section('here')
<p>Penyetoran</p>
@endsection

@section('content')
@if (session('status'))


<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3 text-center">
                <thead>
                    <tr>
                        <th class="">No.</th>
                        <th class="">User_id</th>
                        <th class="">Pengurus1</th>
                        <th class="">PermintaanId</th>
                        <th class="">Keterangan</th>
                        <th class="">Sampah</th>
                        <th class="">Berat</th>
                        <th class="">Debit</th>
                        <th class="">Wilayah</th>
                    </tr>
                </thead>
                <tbody class="filter-box">
                    @foreach($penyetoran as $value)
                    <?php
                    $user   = App\Model\User::where('id', $value->user_id)->first();
                    $alamat = App\Model\Alamat::where('user_id', $value->pengurus1_id)->where('status', 1)->first();
                    $pengurus = App\Model\User::where('id', $value->pengurus1_id)->first();
                    // $role   = App\Model\Role::where('model_id', $value->id)->first();
                    $wilayah= App\Model\Wilayah::where('id', $alamat->wilayah_id)->first();
                    $sampah = App\Model\Sampah::where('id', $value->sampah_id)->first();

                    ?>

                    <tr>
                        <td class="col-1"> {{ $loop->iteration}} </td>
                        <td class="col-1"> {{ $value->user_id}} </td>
                        <td class="col-1"> {{ $pengurus->name}} </td>
                        <td class="col-1"> <a id="permintaan" href="permintaan/{{$value->permintaan_id}}">{{ $value->permintaan_id}} </a></td>
                        <td class="col-1"> {{ $value->keterangan}} </td>
                        <td class="col-1"> {{ $sampah->nama}} </td>
                        <td class="col-1"> {{ $value->berat}} </td>
                        <td class="col-1"> {{ $value->debit}} </td>
                        <td class="col-1"> {{ $wilayah->nama}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="copyright">
            <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
        </div>
    </div>
</div>


@endsection