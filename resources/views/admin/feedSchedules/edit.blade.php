@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h3>Edit Setting Tool</h3>
            </div>
            <div class="card-body">
                <form id="editForm" action="{{ route('feedSchedules.update', $feedSchedules->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label class="mb-2" for="time1">Pakan Ke-1</label>
                            <input class="form-control" type="time" name="time1" value="{{ sprintf('%02d', $feedSchedules->jam1) }}:{{ sprintf('%02d', $feedSchedules->menit1) }}">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="time2" class="mb-2">Pakan Ke-2</label>
                            <input class="form-control" type="time" name="time2" value="{{ sprintf('%02d', $feedSchedules->jam2) }}:{{ sprintf('%02d', $feedSchedules->menit2) }}">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="time3" class="mb-2">Pakan Ke-3</label>
                            <input class="form-control" type="time" name="time3" value="{{ sprintf('%02d', $feedSchedules->jam3) }}:{{ sprintf('%02d', $feedSchedules->menit3) }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                    <a href="{{ route('feedSchedules.index') }}"><button type="button" class="btn btn-danger mt-3">Close</button></a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan sebelum penutupan </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
@endsection

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