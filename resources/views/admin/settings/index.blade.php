@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        {{-- Jadwal Pakan --}}
            <div class="row">
                <div class="col-12 card">
                    <div class="card-title">
                        <div class="card-header">
                            Jadwal Pakan
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>Pakan Ke-1</th>
                                    <th>Pakan Ke-2</th>
                                    <th>Pakan Ke-3</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>09:00 AM</td>
                                    <td>01:00 PM</td>
                                    <td>04:00 PM</td>
                                    <td><button class="btn btn-sm btn-dark"><i class="fas fa-pen-square"></i></button></td>
                                    {{-- Modal JadwalPakan --}}
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="Pakan1">Pakan Ke-1</label>
                                                                <input class="form-control" type="time" name="time1" value="" id="html5-time-input" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="Pakan2">Pakan Ke-2</label>
                                                                <input class="form-control" type="time" name="time2" value="" id="html5-time-input" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="Pakan3">Pakan Ke-3</label>
                                                                <input class="form-control" type="time" name="time3" value="" id="html5-time-input" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    {{-- End Modal Jadwal Pakan --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                <tr>
                                    <td>1</td>
                                    <td>883784783</td>
                                    <td><span class="badge badge-success">Terhubung</span></td>
                                    <td><button class="btn btn-sm btn-dark"><i class="fas fa-pen-square" data-bs-toggle="modal" data-bs-target="#staticBackdropDevices"></i></button></td>
                                    {{-- Modal Device --}}
                                    <div class="modal fade" id="staticBackdropDevices" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Pengaturan Alat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="Pakan3">Key</label>
                                                                <input class="form-control" type="text" placeholder="Edit data kunci..."/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    {{-- EndModal Device --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    
</script>
@endsection
