@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Notifikasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="notifications-table" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Keterangan</th>
                                        <th>Jam</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat di sini melalui AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        function loadNotifications() {
            $.ajax({
                url: "{{ route('notification.data') }}",
                method: 'GET',
                success: function(data) {
                    var tbody = $('#notifications-table tbody');
                    tbody.empty(); // Kosongkan tabel
    
                    data.forEach(function(notification) {
                        var row = '<tr>' +
                            '<td>' + notification.category + '</td>' +
                            '<td>' + notification.keterangan + '</td>' +
                            '<td>' + notification.jam + '</td>' +
                            '<td>' + notification.tanggal + '</td>' +
                            '<td><button class="btn btn-sm btn-dark delete-btn" data-id="' + notification.id + '"><i class="fas fa-trash-alt"></i></button></td>' +
                            '</tr>';
                        tbody.append(row);
                    });
    
                    // Tambahkan event listener untuk tombol hapus
                    $('.delete-btn').click(function() {
                        var id = $(this).data('id');
                        Swal.fire({
                            title: 'Apakah anda yakin menghapus notifikasi ini?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/notifications/' + id,
                                    method: 'DELETE',
                                    data: {
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(response) {
                                        Swal.fire(
                                            'Dihapus!',
                                            response.success,
                                            'success'
                                        );
                                        loadNotifications();
                                    },
                                    error: function(response) {
                                        Swal.fire(
                                            'Error!',
                                            response.error,
                                            'error'
                                        );
                                    }
                                });
                            }
                        });
                    });
                }
            });
        }
    
        // Panggil fungsi loadNotifications setiap 5 detik
        setInterval(loadNotifications, 5000);
    
        // Panggil fungsi loadNotifications saat halaman pertama kali dimuat
        loadNotifications();
    });
    </script>
@endsection