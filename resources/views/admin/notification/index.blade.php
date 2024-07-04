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
                        <table
                          id="basic-datatables"
                          class="display table table-striped table-hover"
                        >
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
                            <tr>
                                <td>Suhu</td>
                                <td>Suhu kolam lebih dari 33 °C segera periksa area kolam dan fan pada kolam!</td>
                                <td>16:25:12</td>
                                <td>2024/06/13</td>
                                <td>
                                <button class="btn btn-sm btn-dark"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Suhu</td>
                                <td>Suhu kolam kurang dari 30 °C segera periksa area kolam dan heater pada kolam!</td>
                                <td>16:25:14</td>
                                <td>2024/06/13</td>
                                <td>
                                <button class="btn btn-sm btn-dark"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Pakan</td>
                                <td>Pakan ikan hampir habis segera isi ulang pakan!</td>
                                <td>16:25:18</td>
                                <td>2024/06/13</td>
                                <td>
                                <button class="btn btn-sm btn-dark"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Pakan</td>
                                <td>Pakan ikan tidak keluar dengan maksimal segera cek alat!</td>
                                <td>16:25:54</td>
                                <td>2024/06/13</td>
                                <td>
                                <button class="btn btn-sm btn-dark"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Kadar PH</td>
                                <td>Kadar PH lebih dari 7,5 segera cek air pada kolam!</td>
                                <td>16:26:18</td>
                                <td>2024/06/13</td>
                                <td>
                                <button class="btn btn-sm btn-dark"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Kadar PH</td>
                                <td>Kadar PH kurang dari 7,2 segera cek air pada kolam!</td>
                                <td>16:26:18</td>
                                <td>2024/06/13</td>
                                <td>
                                <button class="btn btn-sm btn-dark"><i class="fas fa-trash-alt"></i></button>
                                </td>
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