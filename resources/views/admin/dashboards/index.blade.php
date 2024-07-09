@extends('admin.main')

@section('container-admin')
    
<div class="container">
    <div class="page-inner">
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div class="container">
          <div class="row">
            <div class="col-md-2">
              <h3 class="fw-bold">Dashboard</h3>
            </div>
            <div class="col-md-2 ms-auto">
              <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-4">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-danger bubble-shadow-small">
                    <i class="fas fa-thermometer-half"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Suhu</p>
                    <h4 class="card-title" id="suhu"><span>{{ $latestSensorData->suhu }}</span><span> °C</span> </h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-info bubble-shadow-small"
                  >
                    <i class="fas fa-tint"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Kadar Air</p>
                    <h4 class="card-title" id="ph"><span>{{ $latestSensorData->ph }}</span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-success bubble-shadow-small"
                  >
                    <i class="fas fa-battery-full"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Jumlah Pakan</p>
                    <h4 class="card-title" id="pakan"><span>{{ $latestSensorData->pakan }}</span><span>%</span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- <div class="row">
        <div class="col-sm-6 col-md-6">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div class="icon-big text-center icon-danger bubble-shadow-small">
                    <i class="fas fa-thermometer-half"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Nyalakan pendingin jika air di atas 32 °C</p>
                    <div class="form-check form-switch card-title">
                      <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="card card-stats card-round">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-success bubble-shadow-small"
                  >
                    <i class="fas fa-battery-full"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Klik button jika ingin beri pakan manual</p>
                    <div class="card-title"><button class="btn btn-success btn-sm">Beri Pakan</button></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Grafik Temperatur Kolam</div>
            </div>
            <div class="card-body">
              <div class="chart-container">
                <canvas id="myChart" height="100%"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Grafik Kadar PH Kolam</div>
            </div>
            <div class="card-body">
              <div class="chart-container">
                <canvas id="myChartPh" height="100%"></canvas>
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
  document.addEventListener("DOMContentLoaded", function() {
      var ctx = document.getElementById('myChart').getContext('2d');
      var chartData = @json($data1);
      var myChart = new Chart(ctx, {
          type: 'line', // Tipe chart yang ingin Anda buat
          data: chartData,
          options: {
              responsive: true,
              scales: {
                  x: {
                      beginAtZero: true
                  },
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
      var ctx = document.getElementById('myChartPh').getContext('2d');
      var chartData = @json($data2);
      var myChart = new Chart(ctx, {
          type: 'line', // Tipe chart yang ingin Anda buat
          data: chartData,
          options: {
              responsive: true,
              scales: {
                  x: {
                      beginAtZero: true
                  },
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  });
</script>
<script>
  $(document).ready(function () {
      const suhuChartCtx = document.getElementById('myChart').getContext('2d');
      const phChartCtx = document.getElementById('myChartPh').getContext('2d');

      let suhuChart = new Chart(suhuChartCtx, {
          type: 'line',
          data: @json($data1),
          options: {}
      });

      let phChart = new Chart(phChartCtx, {
          type: 'line',
          data: @json($data2),
          options: {}
      });

      function fetchLatestData() {
          $.ajax({
              url: '/get-latest-sensor-data',
              method: 'GET',
              success: function (response) {
                  $('#suhu span').first().text(response.latestSensorData.suhu);
                  $('#ph span').first().text(response.latestSensorData.ph);
                  $('#pakan span').first().text(response.latestSensorData.pakan);

                  suhuChart.data.labels = response.data1.labels;
                  suhuChart.data.datasets[0].data = response.data1.datasets[0].data;
                  suhuChart.update();

                  phChart.data.labels = response.data2.labels;
                  phChart.data.datasets[0].data = response.data2.datasets[0].data;
                  phChart.update();
              }
          });
      }

      setInterval(fetchLatestData, 1000);
  });
</script>
@endsection