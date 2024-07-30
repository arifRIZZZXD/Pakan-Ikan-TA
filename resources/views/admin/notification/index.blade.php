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
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Keterangan</th>
                                        <th>Jam</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="notification-table-body">
                                    @foreach($notifications as $notification)
                                    <tr>
                                        <td>{{ $notification->category }}</td>
                                        <td>{{ $notification->information }}</td>
                                        <td>{{ $notification->time }}</td>
                                        <td>{{ $notification->date }}</td>
                                        <td>
                                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-dark"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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
<script>
    $(document).ready(function() {
        function fetchLatestNotifications() {
            $.ajax({
                url: '/notifications/latest',
                method: 'GET',
                success: function(data) {
                    var tbody = $('#notification-table-body');
                    tbody.empty();
                    data.forEach(function(notification) {
                        tbody.append(`
                            <tr>
                                <td>${notification.category}</td>
                                <td>${notification.information}</td>
                                <td>${notification.time}</td>
                                <td>${notification.date}</td>
                                <td>
                                    <form action="/notifications/${notification.id}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-dark"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        }

        // Fetch notifications every 10 seconds
        setInterval(fetchLatestNotifications, 1000);
    });
</script>
@endsection