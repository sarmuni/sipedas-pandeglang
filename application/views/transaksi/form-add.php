<!-- Begin Page Content -->
<div class="container-fluid">
    <form autocomplete="off" action="<?php echo base_url('transaksi/save_transaksi'); ?>" method="POST">
        <div class="row">

            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0 shadow">
                    <div class="card-header">Form Transaksi</div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="small mb-1" for="code">Kode Transaksi</label>
                            <input class="form-control" id="code" type="text" name="code" value="<?php echo $code; ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="nomor_polisi">Nomor Polisi - Dari Nota Dinas</label>
                            <select class="form-control" id="nomor_polisi" name="nomor_polisi">
                                <option value="">Pilih Nomor Polisi</option>
                                <?php foreach ($kendaraan_notadinas as $k) : ?>
                                    <option value="<?= $k['no_polisi']; ?>"><?= $k['no_polisi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="tanggal_perawatan">Tanggal Perawatan</label>
                            <input class="form-control" id="tanggal_perawatan" type="date" name="tanggal_perawatan">
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="jenis_perawatan">Jenis Perawatan</label>
                            <select class="form-control" id="jenis_perawatan" name="jenis_perawatan">
                                <option value="">Pilih Jenis Perawatan</option>
                                <?php foreach ($jenis_perawatan as $p) : ?>
                                    <option value="<?= $p['id']; ?>"><?= $p['nama_jenis_perawatan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="kilometer_kendaraan">Kilometer Kendaraan</label>
                            <input class="form-control" id="kilometer_kendaraan" type="text" name="kilometer_kendaraan">
                        </div>


                        <div class="mb-3">
                            <label class="small mb-1" for="kode_akun">Kode Akun Anggaran</label>
                            <select class="form-control" id="kode_akun" name="kode_akun">
                                <option value="">Pilih Anggaran</option>
                                <?php foreach ($anggaran as $p) : ?>
                                    <option value="<?= $p['kode_akun']; ?>"><?= $p['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-8 identitas_kendaraan">
                <div class="card mb-4 shadow">
                    <div class="card-header">Detail Kendaraan</div>
                    <div class="card-body">

                        <div class="row gx-3 mb-3">
                            <div class="col-md-2">
                                <label class="small mb-1">Nomor Polisi</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-5">
                                <label class="small mb-1">Nama Pemilik</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-5">
                                <label class="small mb-1">Pengguna Kendaraan</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1">Alamat</label>
                            <input class="form-control" type="text" readonly>
                        </div>


                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1">Merek</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Type</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Jenis</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Model</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1">Tahun Pembuatan</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Isi Silinder</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Nomor Rangka</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Nomor Mesin</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1">Warna</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Tahun Registrasi</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Nomor BPKB</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Tanggal Berlaku</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="card shadow mb-4 identitas_anggaran">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Informasi Anggaran Pertahun</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1">Pagu Anggaran</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1">Realisasi</label>
                                <input class="form-control" type="text" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1">Sisa Anggaran</label>
                                <input class="form-control" type="text" readonly>
                            </div>

                        </div>
                    </div>
                </div> -->


            </div>
        </div>





        <br>

        <div class="card mb-4 shadow">
            <div class="card-header">Detail Transaksi</div>
            <div class="card-body">

                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width:3%">No</th>
                            <th style="width:40%">Nama Barang/Jasa</th>
                            <th style="width:10%">Volume</th>
                            <th style="width:10%">Satuan</th>
                            <th style="width:10%">Harga Satuan</th>
                            <!-- <th style="width:10%">Jumlah</th> -->
                            <th style="width:10%">
                                <center><button type="button" id="btn-tambah-form" class="btn btn-success btn-icon-split btn-sm"> <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Add New</span></button></center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input class="form-control" id="nama_barang" type="text" name="nama_barang[]"></td>
                            <td><input class="form-control volume" id="volume" type="text" name="volume[]" onkeyup="sum();"></td>
                            <td><input class="form-control" id="satuan" type="text" name="satuan[]"></td>
                            <td><input class="form-control harga" id="harga" type="text" name="harga[]" onkeyup="sum();"></td>
                            <!-- <td><input class="form-control jumlah" id="jumlah" type="text" readonly name="jumlah[]"></td> -->
                            <td>
                                <center><button type="button" id="btn-tambah-form" onclick="removeRow('1')" class="btn btn-danger btn-icon-split btn-sm"> <span class="icon text-white-50">
                                            <i class="fas fa-times"></i>
                                        </span>
                                        <span class="text">Remove</span></button></center>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="insert-form"></div>
                <input type="hidden" id="jumlah-form" value="1">
            </div>

            <div class="modal-footer">
                <a href="<?php echo base_url('transaksi'); ?>"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button></a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>

</div>