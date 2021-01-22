@extends('admin.layouts.dashboard')
@section('here')
<p>Penyetoran</p>
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
                    // $role   = App\Model\Role::where('model_id', $value->id)->first();
                    $wilayah= App\Model\Wilayah::where('id', $alamat->wilayah_id)->first();
                    $sampah = App\Model\Sampah::where('id', $value->sampah_id)->first();

                    ?>

                    <tr>
                        <td class="col-1"> {{ $loop->iteration}} </td>
                        <td class="col-1"> {{ $value->user_id}} </td>
                        <td class="col-1"> {{ $value->pengurus1_id}} </td>
                        <td class="col-1"> {{ $value->no_telpon}} </td>
                        <td class="col-1"> {{ $value->permintaan_id}} </td>
                        <td class="col-1"> {{ $sampah->nama}} </td>
                        <td class="col-1"> {{ $value->berat}} </td>
                        <td class="col-1"> {{ $value->debit}} </td>
                        <td class="col-1"> {{ $wilayah->nama}} </td>
                        <td class="d-flex">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLabelUbah{{$user->id}}" title="Edit">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <form action="user/delete/{{$user->id}}" method="post" class="d-inline ml-2" onsubmit="return confirm('yakin hapus data')">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" data-toggle="modal" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </form>

                        </td>
                        <!-- Modal Ubah -->
                        <div class="modal fade" id="ModalLabelUbah{{$user->id}}" tabindex="-1" aria-labelledby="FontModalLabelUbah" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="FontModalLabelUbah">Ubah Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="user/update/{{$user->id}}" method="post">
                                            @method('patch')
                                            @csrf
                                            <div class="form-group row">
                                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nama" value="{{$user->name}}" name="name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="email" value="{{$user->email}}" name="email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_telpon" class="col-sm-2 col-form-label">No Telpon</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="no_telpon" value="{{$user->no_telpon}}" name="no_telpon">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="role" class="col-sm-2 col-form-label">Role</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="role" value="{{$value->role_id}}" name="role">
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
            <form action="user/tambah" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="role_id" name="role_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_telpon" class="col-sm-2 col-form-label">No Telpon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_telpon" name="no_telpon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wilayah_id" class="col-sm-2 col-form-label">Wilayah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="wilayah_id" name="wilayah_id">
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