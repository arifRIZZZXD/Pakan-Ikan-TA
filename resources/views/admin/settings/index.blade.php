@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        {{-- Jadwal Pakan --}}
            {{-- koneksi Alat --}}
            <div class="row">
                <div class="col-12 card">
                    <div class="card-title">
                        <div class="card-header">
                            Pengaturan Alat
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>Minimal Suhu</th>
                                    <th>Maksimal Suhu</th>
                                    <th>Minimal Kadar Ph</th>
                                    <th>Maksimal Kadar Ph</th>
                                    <th>Minimal Pakan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($settingDatas as $data)
                                <tr>
                                    <td>{{ $data->tempMin }} <span>°C</span></td>
                                    <td>{{ $data->tempMax }} <span>°C</span></td>
                                    <td>{{ $data->phMin }} </td>
                                    <td>{{ $data->phMax }} </td>
                                    <td>{{ $data->feedMin }} <span>%</span></td>
                                    <td>
                                        <a href="{{ route('settings.editSettings', $data->id) }}"><button class="btn btn-sm btn-dark"><i class="fas fa-pen-square"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Koneksi Alat --}}
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
                                    <td><button class="btn btn-sm btn-dark"><i class="fas fa-pen-square" data-bs-toggle="modal" data-bs-target="#staticBackdropDevices"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection

{{-- @section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection --}}

{{-- @section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script> --}}
    
</script>
@endsection
