@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
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
                            @foreach ($feedSchedules as $item)
                            <tr>
                                <td>{{ date('h:i A', strtotime(sprintf('%02d', $item->jam1) . ':' . sprintf('%02d', $item->menit1))) }}</td>
                                <td>{{ date('h:i A', strtotime(sprintf('%02d', $item->jam2) . ':' . sprintf('%02d', $item->menit2))) }}</td>
                                <td>{{ date('h:i A', strtotime(sprintf('%02d', $item->jam3) . ':' . sprintf('%02d', $item->menit3))) }}</td>
                                <td><a href="{{ route('feedSchedules.edit', $item->id) }}"><button class="btn btn-sm btn-dark"><i class="fas fa-pen-square"></i></button></a></td>
                            </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection