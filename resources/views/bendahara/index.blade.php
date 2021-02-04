@extends ('bendahara.layouts.dashboard')

@section('content')
<!-- STATISTIC-->
<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <h2 class="number">{{$user}}</h2>
                        <span class="desc">members</span>
                        <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <h2 class="number">{{$penjualan}}</h2>
                        <span class="desc">items sold</span>
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <h2 class="number">{{$pendataan}}</h2>
                        <span class="desc">Pendataan</span>
                        <div class="icon">
                            <i class="zmdi zmdi-calendar-note"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item">
                        <h2 class="number">Rp. {{$saldo_bank->saldo}}</h2>
                        <span class="desc">total earnings</span>
                        <div class="icon">
                            <i class="zmdi zmdi-money"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->

<section>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8">
                    <!-- RECENT REPORT 2-->
                    <div class="recent-report2">
                        <h3 class="title-3">recent reports</h3>
                        <div class="chart-info">
                            <div class="chart-info__left">
                                <div class="chart-note">
                                    <span class="dot dot--blue"></span>
                                    <span>products</span>
                                </div>
                                <div class="chart-note">
                                    <span class="dot dot--green"></span>
                                    <span>Services</span>
                                </div>
                            </div>
                            <div class="chart-info-right">
                                <div class="rs-select2--dark rs-select2--md m-r-10">
                                    <select class="js-select2" name="property">
                                        <option selected="selected">All Properties</option>
                                        <option value="">Products</option>
                                        <option value="">Services</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <div class="rs-select2--dark rs-select2--sm">
                                    <select class="js-select2 au-select-dark" name="time">
                                        <option selected="selected">All Time</option>
                                        <option value="">By Month</option>
                                        <option value="">By Day</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="recent-report__chart">
                            <canvas id="recent-rep2-chart"></canvas>
                        </div>
                    </div>
                    <!-- END RECENT REPORT 2             -->
                </div>
                <div class="col-xl-4">
                    <!-- TASK PROGRESS-->
                    <div class="task-progress">
                        <h3 class="title-3">task progress</h3>
                        <div class="au-skill-container">
                            @foreach($gudang as $item)
                            <?php
                                $sampah = App\Model\Sampah::where('id', $item->sampah_id)->first();

                                $jumlah = $item->berat / 50 * 100;
                            ?>
                            <div class="au-progress">
                                <span class="au-progress__title">{{$sampah->nama}}</span>
                                <div class="au-progress__bar">
                                    <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="{{$jumlah}}">
                                        <span class="au-progress__value js-value"></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- END TASK PROGRESS-->
                </div>
            </div>
        </div>
    </div>
</section>


</div>
<div class="col-xl-6">
    <!-- MAP DATA-->
    <div class="map-data m-b-40">
        <h3 class="title-3 m-b-30">
            <i class="zmdi zmdi-map"></i>map data</h3>
        <div class="filters">
            <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                <select class="js-select2" name="property">
                    <option selected="selected">All Worldwide</option>
                    <option value="">Products</option>
                    <option value="">Services</option>
                </select>
                <div class="dropDownSelect2"></div>
            </div>
            <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                <select class="js-select2 au-select-dark" name="time">
                    <option selected="selected">All Time</option>
                    <option value="">By Month</option>
                    <option value="">By Day</option>
                </select>
                <div class="dropDownSelect2"></div>
            </div>
        </div>
        <div class="map-wrap m-t-45 m-b-80">
            <div id="vmap" style="height: 284px;"></div>
        </div>
        <div class="table-wrap">
            <div class="table-responsive table-style1">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>United States</td>
                            <td>$119,366.96</td>
                        </tr>
                        <tr>
                            <td>Australia</td>
                            <td>$70,261.65</td>
                        </tr>
                        <tr>
                            <td>United Kingdom</td>
                            <td>$46,399.22</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive table-style1">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Germany</td>
                            <td>$20,366.96</td>
                        </tr>
                        <tr>
                            <td>France</td>
                            <td>$10,366.96</td>
                        </tr>
                        <tr>
                            <td>Russian</td>
                            <td>$5,366.96</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END MAP DATA-->
</div>
</div>
</div>
</div>
</section>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END PAGE CONTAINER-->


@endsection