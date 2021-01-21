@extends('admin.layouts.dashboard')
@section('here')
<p>Nasabah</p>
@endsection

@section('button')
<!-- Button trigger modal -->
<button type="button" class="au-btn au-btn-icon au-btn--green" data-toggle="modal" data-target="#ModalLabelTambah">
    <i class="zmdi zmdi-plus"></i>add value
</button>

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
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>No Telpon</th>
                        <th>Alamat</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="filter-box">
                    @foreach($users as $value)
                    <?php
                    $alamat = App\Model\Alamat::where('user_id', $value->id)->where('status', 1)->first();
                    $role   = App\Model\Role::where('model_id', $value->id)->first();


                    ?>

                    <tr>
                        <td> {{ $loop->iteration}} </td>
                        <td> {{ $value->name}} </td>
                        <td> {{ $value->email}} </td>
                        <td> {{ $value->no_telpon}} </td>
                        <td> {{ $alamat->alamat}} </td>
                        <td> <?php
                            if ($role->role_id == 1) {
                                echo "admin";
                            } else if ($role->role_id == 2) {
                                echo "Bendahara";
                            } elseif ($role->role_id == 3) {
                                echo "Costumer Service";
                            } elseif ($role->role_id == 4) {
                                echo "Pengurus 1";
                            } elseif ($role->role_id == 5) {
                                echo "Pengurus 2";
                            } elseif ($role->role_id == 6) {
                                echo "Nasabah";
                            }
                        ?> </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLabelUbah{{$value->id}}" title="Edit">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <form action="sampah/delete/{{$value->id}}" method="post" class="d-inline" onsubmit="return confirm('yakin hapus data')">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" data-toggle="modal" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </form>

                        </td>
                        <!-- Modal Ubah -->
                        <div class="modal fade" id="ModalLabelUbah{{$value->id}}" tabindex="-1" aria-labelledby="FontModalLabelUbah" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="FontModalLabelUbah">Ubah Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="sampah/update/{{$value->id}}" method="post">
                                            @method('patch')
                                            @csrf
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nama" value="{{$value->nama}}" name="nama">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="harga" class="col-sm-2 col-form-label">Price</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="harga" value="{{$value->harga}}" name="harga">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>

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


<!-- Modal Tambah -->
<div class="modal fade" id="ModalLabelTambah" tabindex="-1" aria-labelledby="FontModalLabelTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="FontModalLabelTambah">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="sampah/tambah" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga" name="harga">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection