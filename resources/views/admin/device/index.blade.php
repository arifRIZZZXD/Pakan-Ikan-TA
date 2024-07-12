@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12 card">
                <div class="card-title">
                    <div class="card-header">
                        Koneksi Alat
                    </div>
                </div>
                <div class="card-body">
                    <table class="table mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Key</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($deviceKey as $item)
                                
                            @endforeach --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <span class="badge badge-success">Terhubung</span>
                                    <span class="badge badge-danger">Terputus</span>
                                </td>
                                <td><button class="btn btn-sm btn-dark"><i class="fas fa-pen-square"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

