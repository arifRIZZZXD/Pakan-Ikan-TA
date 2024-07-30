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
                                <td>{{ date('h:i A', strtotime(sprintf('%02d', $item->hourOne) . ':' . sprintf('%02d', $item->minuteOne))) }}</td>
                                <td>{{ date('h:i A', strtotime(sprintf('%02d', $item->hourTwo) . ':' . sprintf('%02d', $item->minuteTwo))) }}</td>
                                <td>{{ date('h:i A', strtotime(sprintf('%02d', $item->hourThree) . ':' . sprintf('%02d', $item->minuteThree))) }}</td>
                                <td><a href="{{ route('feedSchedules.edit', $item->id) }}"><button class="btn btn-sm btn-dark"><i class="fas fa-pen-square"></i></button></a></td>
                            </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                </div>
            </div>
            <div class="col-md-12 card">
                  <div class="card-header">
                    <h4 class="card-title">Cara Mengubah Jadwal feed</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5 col-md-2">
                        <div
                          class="nav flex-column nav-pills nav-secondary"
                          id="v-pills-tab"
                          role="tablist"
                          aria-orientation="vertical"
                        >
                          <a
                            class="nav-link active"
                            id="v-pills-home-tab"
                            data-bs-toggle="pill"
                            href="#v-pills-home"
                            role="tab"
                            aria-controls="v-pills-home"
                            aria-selected="true"
                            >Note</a
                          >
                          <a
                            class="nav-link"
                            id="v-pills-profile-tab"
                            data-bs-toggle="pill"
                            href="#v-pills-profile"
                            role="tab"
                            aria-controls="v-pills-profile"
                            aria-selected="false"
                            >Cara Pakai</a
                          >
                        </div>
                      </div>
                      <div class="col-7 col-md-10">
                        <div class="tab-content" id="v-pills-tabContent">
                          <div
                            class="tab-pane fade show active"
                            id="v-pills-home"
                            role="tabpanel"
                            aria-labelledby="v-pills-home-tab"
                          >
                            <p>
                              Far far away, behind the word mountains, far from
                              the countries Vokalia and Consonantia, there live
                              the blind texts. Separated they live in
                              Bookmarksgrove right at the coast of the
                              Semantics, a large language ocean.
                            </p>

                            <p>
                              A small river named Duden flows by their place and
                              supplies it with the necessary regelialia. It is a
                              paradisematic country, in which roasted parts of
                              sentences fly into your mouth.
                            </p>
                          </div>
                          <div
                            class="tab-pane fade"
                            id="v-pills-profile"
                            role="tabpanel"
                            aria-labelledby="v-pills-profile-tab"
                          >
                            <p>
                              Even the all-powerful Pointing has no control
                              about the blind texts it is an almost
                              unorthographic life One day however a small line
                              of blind text by the name of Lorem Ipsum decided
                              to leave for the far World of Grammar.
                            </p>
                            <p>
                              The Big Oxmox advised her not to do so, because
                              there were thousands of bad Commas, wild Question
                              Marks and devious Semikoli, but the Little Blind
                              Text didn’t listen. She packed her seven versalia,
                              put her initial into the belt and made herself on
                              the way.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
        </div>
    </div>
</div>
@endsection