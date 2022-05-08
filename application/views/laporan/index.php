<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header">
            Laporan
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <td>
                        <ul class="nav nav-tabs flex-column border-left-success">

                            <li><a href="#home" class="btn btn-light btn-icon-split nav-link" data-toggle="tab">
                                    <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Menu Laporan</span>
                                </a>
                            </li>

                            <li><a href="#menu1" class="btn btn-light btn-icon-split nav-link" data-toggle="tab">
                                    <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Kendaraan</span>
                                </a>
                            </li>

                            <li><a href="#menu2" class="btn btn-light btn-icon-split nav-link" data-toggle="tab">
                                    <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Perawatan</span>
                                </a>
                            </li>

                            <li><a href="#menu3" class="btn btn-light btn-icon-split nav-link" data-toggle="tab">
                                    <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Transaksi</span>
                                </a>
                            </li>

                            <li><a href="#menu4" class="btn btn-light btn-icon-split nav-link" data-toggle="tab">
                                    <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Anggaran</span>
                                </a>
                            </li>

                        </ul>
                    </td>

                    <td>
                        <div class="tab-content border-bottom-success">

                            <div id="home" class="tab-pane active">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Menu Laporan
                                    </div>
                                    <div class="card-body">
                                        Silahkan pilih menu laporan yang diinginkan.
                                    </div>
                                </div>
                            </div>
                            <!-- Kendaraan -->
                            <div id="menu1" class="tab-pane fade">
                                <form name="frmlaporankendaraan" id="frmlaporankendaraan" role="form" action="#">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            Menu Laporan Kendaraan
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered bg-gray-100" id="dataTable" width="100%" cellspacing="0">
                                                <tr>
                                                    <td>Merek Kendaraan</td>
                                                    <td>
                                                        <center>:</center>
                                                    </td>
                                                    <td><select class="form-control id_merek" id="id_merek" name="id_merek">
                                                            <option value="0">Semua</option>
                                                            <?php foreach ($jenis_kendaraan as $k) : ?>
                                                                <option value="<?= $k['id']; ?>"><?= $k['nama_jenis_kendaraan']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td>Periode Registrasi</td>
                                                    <td>
                                                        <center>:</center>
                                                    </td>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td><input class="form-control tanggal_awal" id="tanggal_awal" type="date" name="tanggal_awal"></td>
                                                                <td><input class="form-control tanggal_akhir" id="tanggal_akhir" type="date" name="tanggal_akhir"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" id="btn_cetak_kendaraan" class="btn btn-success btn_cetak_kendaraan">Cetak PDF</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end kendaraan -->


                            <div id="menu2" class="tab-pane fade">
                                <form name="frmlaporanperawatan" id="frmlaporanperawatan" role="form" action="#">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            Menu Laporan Perawatan Kendaraan
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered bg-gray-100" id="dataTable" width="100%" cellspacing="0">
                                                <tr>
                                                    <td>Jenis Perawatan</td>
                                                    <td>
                                                        <center>:</center>
                                                    </td>
                                                    <td><select class="form-control jenis_perawatan" id="jenis_perawatan" name="jenis_perawatan">
                                                            <option value="">Pilih Perawatan</option>
                                                            <?php foreach ($jenis_perawatan as $k) : ?>
                                                                <option value="<?= $k['id']; ?>"><?= $k['nama_jenis_perawatan']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td>Periode Tanggal</td>
                                                    <td>
                                                        <center>:</center>
                                                    </td>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td><input class="form-control tanggal_awal_perawatan" id="tanggal_awal_perawatan" type="date" name="tanggal_awal_perawatan"></td>
                                                                <td><input class="form-control tanggal_akhir_perawatan" id="tanggal_akhir_perawatan" type="date" name="tanggal_akhir_perawatan"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" id="btn_cetak_perawatan" class="btn btn-success btn_cetak_perawatan">Cetak PDF</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="menu3" class="tab-pane fade">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Menu Laporan Perawatan
                                    </div>
                                    <div class="card-body">
                                        This card uses Bootstrap's default styling with no utility classes added. Global
                                        styles are the only things modifying the look and feel of this default card example.
                                    </div>
                                </div>
                            </div>

                            <div id="menu4" class="tab-pane fade">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Menu Laporan Anggaran
                                    </div>
                                    <div class="card-body">
                                        This card uses Bootstrap's default styling with no utility classes added. Global
                                        styles are the only things modifying the look and feel of this default card example.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>
</div>