<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-4">
            <div class="card shadow mb-4 mb-xl-0">
                <div class="card-header">Logo</div>
                <div class="card-body text-center">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" width="200">
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header"><?= $title; ?></div>
                <div class="card-body">

                    <div class="row gx-3 mb-3">

                        <div class="col-md-6">
                            <label class="small mb-1">Nama</label>
                            <input class="form-control" value="<?= $user['name']; ?>" type="text" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="small mb-1">Email</label>
                            <input class="form-control" value="<?= $user['email']; ?>" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="small mb-1">Actived</label>
                            <input class="form-control" value="Actived" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="small mb-1">Register</label>
                            <input class="form-control" value="<?= date('d F Y', $user['date_created']); ?>" readonly>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <hr>
    <br>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold"><?= $title; ?></h6>
            </div>
            <div class="card-body">

                <div class="row">
                    <!-- Total Kendaraan Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Kendaraan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($kendaraan); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-car fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Total Perawatan Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Perawatan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php foreach ($perawatan as $row) {
                                                $total_perawatan = $row['total'];
                                                echo number_format($row['total']);
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Anggaran</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php foreach ($anggaran as $row) {
                                                $jan = $row['jan'];
                                                $feb = $row['feb'];
                                                $mar = $row['mar'];
                                                $apr = $row['apr'];
                                                $mei = $row['mei'];
                                                $jun = $row['jun'];
                                                $jul = $row['jul'];
                                                $agu = $row['ags'];
                                                $sep = $row['sep'];
                                                $okt = $row['okt'];
                                                $nov = $row['nov'];
                                                $des = $row['des'];
                                                $total_anggaran = $jan + $feb + $mar + $apr + $mei + $jun + $jul + $agu + $sep + $okt + $nov + $des;
                                                echo number_format($total_anggaran);
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total Sisa Anggaran</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($total_anggaran - $total_perawatan); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                Monitoring pemeliharaan kendaraan dinas dari beban anggaran tahun <?= date('Y'); ?>.
            </div>
        </div>


        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Perawatan Tahun <?= date('Y'); ?></h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="myAreaChart" style="display: block; width: 1037px; height: 320px;" class="chartjs-render-monitor" width="1037" height="320"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Anggaran Tahun <?= date('Y'); ?></h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="myPieChart" style="display: block; width: 486px; height: 245px;" class="chartjs-render-monitor" width="486" height="245"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Perawatan
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Anggaran
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Sisa
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- End of Main Content -->


</div>
<!-- End of Main Content -->