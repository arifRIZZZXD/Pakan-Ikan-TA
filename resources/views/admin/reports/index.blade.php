@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Laporan Sistem</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table
                          id="basic-datatables"
                          class="display table table-striped table-hover"
                        >
                          <thead>
                            <tr>
                                <th>No</th>
                                <th>Jumlah Pakan</th>
                                <th>Suhu</th>
                                <th>Kadar Air</th>
                                <th>Tanggal</th>
                                <th>Pakan Keluar</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>80%</td>
                              <td>27 °C</td>
                              <td>7.4</td>
                              <td>2024/06/13</td>
                              <td>3</td>
                              <td><span class="badge badge-success">Safe</span></td>
                              <td><a href="detailLaporan"><button class="btn btn-dark btn-sm"><i class="fas fa-solid fa-download"></i></button></a></td>
                            </tr>
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