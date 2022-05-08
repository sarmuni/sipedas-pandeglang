<?php foreach ($transaksi as $row) {
    $id = $row['id'];
    $code = $row['code'];
    $nomor_polisi = $row['nomor_polisi'];
    $tanggal_perawatan = $row['tanggal_perawatan'];
    $jenis_perawatan1 = $row['jenis_perawatan'];
    $kilometer_kendaraan = $row['kilometer_kendaraan'];
    $kode_akun = $row['kode_akun'];
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <form autocomplete="off" action="<?php echo base_url('transaksi/save_edit_transaksi'); ?>/<?php echo $id; ?>" method="POST">
        <div class="row">

            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0 shadow">
                    <div class="card-header">Form Edit Transaksi</div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="small mb-1" for="code">Kode Transaksi</label>
                            <input class="form-control" id="code" type="text" name="code" value="<?php echo $code; ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="nomor_polisi">Nomor Polisi</label>
                            <select class="form-control" id="nomor_polisi" name="nomor_polisi">
                                <option value="">Pilih Nomor Polisi</option>
                                <?php foreach ($jenis_kendaraan as $k) : ?>
                                    <?php if ($nomor_polisi == $k['nomor_polisi']) { ?>
                                        <option value="<?= $k['nomor_polisi']; ?>" selected><?= $k['nomor_polisi']; ?> - <?= $k['type']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $k['nomor_polisi']; ?>"><?= $k['nomor_polisi']; ?> - <?= $k['type']; ?></option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="tanggal_perawatan">Tanggal Perawatan</label>
                            <input class="form-control" id="tanggal_perawatan" type="date" name="tanggal_perawatan" value="<?php echo $tanggal_perawatan; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="jenis_perawatan">Jenis Perawatan</label>
                            <select class="form-control" id="jenis_perawatan" name="jenis_perawatan">
                                <option value="">Pilih Jenis Perawatan</option>
                                <?php foreach ($jenis_perawatan as $p) : ?>
                                    <?php if ($jenis_perawatan1 == $p['id']) { ?>
                                        <option value="<?= $p['id']; ?>" selected><?= $p['nama_jenis_perawatan']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $p['id']; ?>"><?= $p['nama_jenis_perawatan']; ?></option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="kilometer_kendaraan">Kilometer Kendaraan</label>
                            <input class="form-control" id="kilometer_kendaraan" type="text" name="kilometer_kendaraan" value="<?php echo $kilometer_kendaraan; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="kode_akun">Kode Akun Anggaran</label>
                            <select class="form-control" id="kode_akun" name="kode_akun">
                                <option value="">Pilih Anggaran</option>
                                <?php foreach ($anggaran as $p) : ?>
                                    <?php if ($kode_akun == $p['kode_akun']) { ?>
                                        <option value="<?= $p['kode_akun']; ?>" selected><?= $p['nama_akun']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $p['kode_akun']; ?>"><?= $p['nama_akun']; ?></option>
                                    <?php } ?>
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
                                <input class="form-control" type="text" value="<?php echo $k['nomor_polisi']; ?>" readonly>
                            </div>
                            <div class="col-md-5">
                                <label class="small mb-1">Nama Pemilik</label>
                                <input class="form-control" type="text" value="<?php echo $k['nama_pemilik']; ?>" readonly>
                            </div>
                            <div class="col-md-5">
                                <label class="small mb-1">Pengguna Kendaraan</label>
                                <input class="form-control" type="text" value="<?php echo $k['pengguna_kendaraan']; ?>" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1">Alamat</label>
                            <input class="form-control" type="text" value="<?php echo $k['alamat']; ?>" readonly>
                        </div>


                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1">Merek</label>
                                <input class="form-control" type="text" value="<?php echo $k['id_merek']; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Type</label>
                                <input class="form-control" type="text" value="<?php echo $k['type']; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Jenis</label>
                                <input class="form-control" type="text" value="<?php echo $k['jenis']; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Model</label>
                                <input class="form-control" type="text" value="<?php echo $k['model']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1">Tahun Pembuatan</label>
                                <input class="form-control" type="text" value="<?php echo $k['tahun_pembuatan']; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Isi Silinder</label>
                                <input class="form-control" type="text" value="<?php echo $k['silinder']; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Nomor Rangka</label>
                                <input class="form-control" type="text" value="<?php echo $k['nomor_rangka']; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Nomor Mesin</label>
                                <input class="form-control" type="text" value="<?php echo $k['nomor_mesin']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1">Warna</label>
                                <input class="form-control" type="text" value="<?php echo $k['warna']; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Tahun Registrasi</label>
                                <input class="form-control" type="text" value="<?php echo $k['tahun_registrasi']; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Nomor BPKB</label>
                                <input class="form-control" type="text" value="<?php echo $k['nomor_bpkb']; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1">Tanggal Berlaku</label>
                                <input class="form-control" type="text" value="<?php echo $k['tanggal_berlaku']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <?php if (isset($transaksi_detail)) : ?>
                                <?php $nextform = 1; ?>
                                <?php foreach ($transaksi_detail as $key => $row2) { ?>
                                    <td><?php echo $nextform; ?></td>
                                    <td><input class="form-control" id="nama_barang" type="text" name="nama_barang[]" value="<?php echo $row2['nama_barang']; ?>"></td>
                                    <td><input class="form-control" id="volume" type="text" name="volume[]" value="<?php echo $row2['volume']; ?>"></td>
                                    <td><input class=" form-control" id="satuan" type="text" name="satuan[]" value="<?php echo $row2['satuan']; ?>"></td>
                                    <td><input class=" form-control" id="harga" type="text" name="harga[]" value="<?php echo $row2['harga']; ?>"></td>
                                    <!-- <td><input class=" form-control" id="jumlah" type="text" name="jumlah[]" value="<?php echo $row2['jumlah']; ?>"></td> -->
                                    <td>
                                        <?php if ($row2['id_detail']) { ?>
                                            <center><a role="button" href="<?php echo site_url(); ?>transaksi/delete_items/<?php echo $row['id']; ?>/<?php echo $row2['id_detail']; ?>/<?php echo $row2['code_transaksi']; ?>" class="btn btn-danger btn-icon-split btn-sm">
                                                    <span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Remove</span></a></center>
                                        <?php } else { ?>
                                            <center><button type=" button" id="btn-tambah-form" onclick="removeRow()" class="btn btn-danger btn-icon-split btn-sm"> <span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Remove</span></button></center>
                                        <?php } ?>
                                    </td>
                        </tr>
                        <?php $nextform++; ?>
                    <?php } ?>
                <?php endif; ?>
                    </tbody>
                </table>
                <div id="insert-form"></div>
                <input type="hidden" id="jumlah-form" value="1">
            </div>

            <div class="modal-footer">
                <a href="<?php echo base_url('transaksi'); ?>"><button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button></a>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>

</div>