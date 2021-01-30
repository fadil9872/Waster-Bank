@extends('bendahara.layouts.dashboard')
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
                        <th class="">Pengurus 2</th>
                        <th class="">Pembeli</th>
                        <th class="">Gudang Id</th>
                        <th class="">Berat</th>
                        <th class="">Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="filter-box">
                    @foreach($penjualan as $value)
                    <?php
                    $gudang = App\Model\Gudang::where('id', $value->gudang_id)->first();

                    $sampah = App\Model\Sampah::where('id', $gudang->sampah_id)->first();

                    ?>

                    <tr>
                        <td class="col-1"> {{ $loop->iteration}} </td>
                        <td class="col-1"> {{ $value->pengurus2_id}} </td>
                        <td class="col-1"> {{ $value->pembeli}} </td>
                        <td class="col-1"> {{ $sampah->nama}} </td>
                        <td class="col-1"> {{ $value->berat}} </td>
                        <td class="col-1"> {{ $value->pendapatan}} </td>
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