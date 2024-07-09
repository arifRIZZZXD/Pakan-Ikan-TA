@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h3>Edit Setting Tool</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.update', $settingDatas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempMin" >Minimal Suhu:</label>
                                <input class="form-control" type="text" id="tempMin" name="tempMin" value="{{ $settingDatas->tempMin }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempMax">Maksimal Suhu:</label>
                                <input class="form-control" type="text" id="tempMax" name="tempMax" value="{{ $settingDatas->tempMax }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phMin">Minimal PH:</label>
                                <input class="form-control" type="text" id="phMin" name="phMin" value="{{ $settingDatas->phMin }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phMax">Maksimal PH:</label>
                                <input class="form-control" type="text" id="phMax" name="phMax" value="{{ $settingDatas->phMax }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="feedMin">Minimal Pakan:</label>
                                <input class="form-control" type="text" id="feedMin" name="feedMin" value="{{ $settingDatas->feedMin }}">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="alert_demo_7">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $("#alert_demo_7").click(function (e) {
        e.preventDefault();
        swal({
            title: "Apakah ingin merubah Jadwal Pakan?",
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Batal",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                },
                confirm: {
                    text: "Ya, ubah!",
                    value: true,
                    visible: true,
                    className: "btn btn-success",
                    closeModal: true,
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                swal({
                    title: "Diubah!",
                    text: "Selamat, data berhasil diubah!",
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                }).then(() => {
                    $("#editForm").submit();
                });
            } else {
                swal.close();
            }
        });
    });
</script>
@endsection