<?php foreach ($kendaraan as $row) {
    $id = $row['id'];
    $kode_qr = $row['kode_qr'];
    $kode_opd = $row['kode_opd'];
    $jenis_assets = $row['jenis_assets'];
    $nomor_polisi = $row['nomor_polisi'];
    $nama_pemilik = $row['nama_pemilik'];
    $alamat = $row['alamat'];
    $pengguna_kendaraan = $row['pengguna_kendaraan'];
    $id_merek = $row['id_merek'];
    $type = $row['type'];
    $jenis = $row['jenis'];
    $tahun_pembuatan = $row['tahun_pembuatan'];
    $model = $row['model'];
    $warna = $row['warna'];
    $nomor_rangka = $row['nomor_rangka'];
    $nomor_mesin = $row['nomor_mesin'];
    $silinder = $row['silinder'];
    $nomor_bpkb = $row['nomor_bpkb'];
    $warna_tnkb = $row['warna_tnkb'];
    $tahun_registrasi = $row['tahun_registrasi'];
    $tanggal_berlaku = $row['tanggal_berlaku'];
    $berat_kb = $row['berat_kb'];
    $jumlah_sumbu = $row['jumlah_sumbu'];
    $jbb_penumpang = $row['jbb_penumpang'];
    $harga_pembelian = $row['harga_pembelian'];
    $tahun_penyusutan = $row['tahun_penyusutan'];
    $keterangan = $row['keterangan'];
    $id_bahan_bakar = $row['id_bahan_bakar'];
    $gambar_depan = $row['gambar_depan'];
    $gambar_belakang = $row['gambar_belakang'];
    $gambar_samping_kiri = $row['gambar_samping_kiri'];
    $gambar_samping_kanan = $row['gambar_samping_kanan'];
} ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <?= form_open_multipart('transaksi/save_edit_kendaraan'); ?>
    <div class="row">

        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card shadow mb-4 mb-xl-0">
                <div class="card-header">Gambar Depan</div>
                <div class="card-body text-center">
                    <center><img class="img-account-profile mb-2" id="file-ip-1-preview1" width="360" src="<?php echo base_url(); ?>assets/img/<?= $gambar_depan; ?>" alt="" width="360px"> </center>
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_depan" name="gambar_depan" accept="image/*" onchange="showPreview1(event);">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <label class="custom-file-label" for="gambar_depan">Choose file</label>
                    </div>
                </div>
            </div>
            <br>
            <!-- Profile picture card-->
            <div class="card shadow mb-4 mb-xl-0">
                <div class="card-header">Gambar Belakang</div>
                <div class="card-body text-center">
                    <center> <img class="img-account-profile mb-2" id="file-ip-1-preview2" width="360" src="<?php echo base_url(); ?>assets/img/<?= $gambar_belakang; ?>" alt="" width="360px"> </center>
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_belakang" name="gambar_belakang" accept="image/*" onchange="showPreview2(event);">
                        <label class="custom-file-label" for="gambar_belakang">Choose file</label>
                    </div>
                </div>
            </div>
            <br>
            <!-- Profile picture card-->
            <div class="card shadow mb-4 mb-xl-0">
                <div class="card-header">Gambar Samping Kiri</div>
                <div class="card-body text-center">
                    <center> <img class="img-account-profile mb-2" id="file-ip-1-preview3" width="360" src="<?php echo base_url(); ?>assets/img/<?= $gambar_samping_kiri; ?>" alt="" width="360px"> </center>
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_samping_kiri" name="gambar_samping_kiri" accept="image/*" onchange="showPreview3(event);">
                        <label class="custom-file-label" for="gambar_samping_kiri">Choose file</label>
                    </div>
                </div>
            </div>
            <br>
            <!-- Profile picture card-->
            <div class="card shadow mb-4 mb-xl-0">
                <div class="card-header">Gambar Samping Kanan</div>
                <div class="card-body text-center">
                    <center> <img class="img-account-profile mb-2" id="file-ip-1-preview4" width="360" src="<?php echo base_url(); ?>assets/img/<?= $gambar_samping_kanan; ?>" alt="" width="360px"> </center>
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_samping_kanan" name="gambar_samping_kanan" accept="image/*" onchange="showPreview4(event);">
                        <label class="custom-file-label" for="gambar_samping_kanan">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header">Identitas Kendaraan</div>
                <div class="card-body">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="kode_qr">Kode QR</label>
                            <input class="form-control" id="kode_qr" type="text" name="kode_qr" placeholder="" value="<?= $kode_qr; ?>" readonly>
                            <?= form_error('kode_qr', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <div class="col-md-6">
                                <label class="small mb-1" for="kode_opd">OPD/ Instansi</label>
                                <select name="kode_opd" id="kode_opd" class="form-control">
                                    <option value="">Pilih OPD/Instansi</option>
                                    <?php foreach ($list_opd as $op) : ?>
                                        <?php if ($kode_opd == $op['kode_opd']) { ?>
                                            <option value="<?= $op['kode_opd']; ?>" selected><?= $op['nama_opd']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $op['kode_opd']; ?>"><?= $op['nama_opd']; ?></option>
                                        <?php } ?>

                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('kode_opd', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-6">
                                <label class="small mb-1" for="kode_opd">OPD/ Instansi</label>
                                <input type="hidden" class="form-control" id="kode_opd" name="kode_opd" value="<?= $opd['kode_opd']; ?>">
                                <input type="text" class="form-control" value="<?= $opd['nama_opd']; ?>" placeholder="Kode OPD" readonly>
                                <?= form_error('kode_opd', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="nomor_polisi">Nomor Polisi</label>
                            <input class="form-control" id="nomor_polisi" type="text" name="nomor_polisi" placeholder="" value="<?= $nomor_polisi; ?>">
                            <?= form_error('nomor_polisi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="nama_pemilik">Nama Pemilik</label>
                            <input class="form-control" id="nama_pemilik" type="text" name="nama_pemilik" placeholder="" value="<?= $nama_pemilik; ?>">
                            <?= form_error('nama_pemilik', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="alamat">Alamat</label>
                        <input class="form-control" id="alamat" type="text" name="alamat" placeholder="" value="<?= $alamat; ?>">
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="pengguna_kendaraan">Pengguna Kendaraan</label>
                            <input class="form-control" id="pengguna_kendaraan" type="text" name="pengguna_kendaraan" placeholder="" value="<?= $pengguna_kendaraan; ?>">
                            <?= form_error('pengguna_kendaraan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="jenis_assets">Jenis Assets</label>
                            <select class="form-control" id="jenis_assets" name="jenis_assets">
                                <option value="">Pilih Jenis Assets</option>
                                <?php foreach ($list_assets as $ja) : ?>
                                    <?php if ($jenis_assets == $ja['id']) { ?>
                                        <option value="<?= $ja['id']; ?>" selected><?= $ja['nama_assets']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $ja['id']; ?>"><?= $ja['nama_assets']; ?></option>
                                    <?php } ?>
                                <?php endforeach; ?>
                                <?= form_error('jenis_assets', '<small class="text-danger pl-3">', '</small>'); ?>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="id_merek">Merek</label>
                            <select class="form-control" id="id_merek" name="id_merek" value="<?= $id_merek; ?>">
                                <option value="">Pilih Merek</option>
                                <?php foreach ($merek as $m) :
                                    if ($id_merek == $m['id']) { ?>
                                        <option value=" <?php echo $m['id']; ?>" selected><?php echo $m['nama_jenis_kendaraan']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $m['id']; ?>"><?php echo $m['nama_jenis_kendaraan']; ?></option>
                                    <?php } ?>

                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_merek', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="warna">Warna</label>
                            <input class="form-control" id="warna" type="text" name="warna" placeholder="" value="<?= $warna; ?>">
                            <?= form_error('warna', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="type">Type</label>
                            <input class="form-control" id="type" type="text" name="type" placeholder="" value="<?= $type; ?>">
                            <?= form_error('type', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="id_bahan_bakar">Bahan Bakar</label>
                            <select class="form-control" id="id_bahan_bakar" name="id_bahan_bakar" value="<?= $id_bahan_bakar; ?>">
                                <option value="">Pilih Bahan Bakar</option>
                                <?php foreach ($bahan_bakar as $bb) : ?>
                                    <?php if ($id_bahan_bakar == $bb['id']) { ?>
                                        <option value="<?php echo $bb['id']; ?>" selected><?php echo $bb['nama_bahan_bakar']; ?></option>
                                    <?php  } else { ?>
                                        <option value="<?php echo $bb['id']; ?>"><?php echo $bb['nama_bahan_bakar']; ?></option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_bahan_bakar', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="jenis">Jenis</label>
                            <input class="form-control" id="jenis" type="text" name="jenis" placeholder="" value="<?= $jenis; ?>">
                            <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="warna_tnkb">Warna TNKB</label>
                            <input class="form-control" id="warna_tnkb" type="text" name="warna_tnkb" placeholder="" value="<?= $warna_tnkb; ?>">
                            <?= form_error('warna_tnkb', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="model">Model</label>
                            <input class="form-control" id="model" type="text" name="model" placeholder="" value="<?= $model; ?>">
                            <?= form_error('model', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="tahun_registrasi">Tahun Registrasi</label>
                            <input class="form-control" id="tahun_registrasi" type="text" name="tahun_registrasi" placeholder="" value="<?= $tahun_registrasi; ?>">
                            <?= form_error('tahun_registrasi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="tahun_pembuatan">Tahun Pembuatan</label>
                            <input class="form-control" id="tahun_pembuatan" type="text" name="tahun_pembuatan" placeholder="" value="<?= $tahun_pembuatan; ?>">
                            <?= form_error('tahun_pembuatan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="nomor_bpkb">Nomor BPKB</label>
                            <input class="form-control" id="nomor_bpkb" type="text" name="nomor_bpkb" placeholder="" value="<?= $nomor_bpkb; ?>">
                            <?= form_error('nomor_bpkb', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="silinder">Isi Silinder</label>
                            <input class="form-control" id="silinder" type="text" name="silinder" placeholder="" value="<?= $silinder; ?>">
                            <?= form_error('silinder', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="tanggal_berlaku">Berlaku S/D</label>
                            <input class="form-control" id="tanggal_berlaku" type="date" name="tanggal_berlaku" placeholder="" value="<?= $tanggal_berlaku; ?>">
                            <?= form_error('tanggal_berlaku', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="nomor_rangka">Nomor Rangka</label>
                            <input class="form-control" id="nomor_rangka" type="text" name="nomor_rangka" placeholder="" value="<?= $nomor_rangka; ?>">
                            <?= form_error('nomor_rangka', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="berat_kb">Berat KB</label>
                            <input class="form-control" id="berat_kb" type="text" name="berat_kb" placeholder="" value="<?= $berat_kb; ?>">
                            <?= form_error('berat_kb', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="nomor_mesin">Nomor Mesin</label>
                            <input class="form-control" id="nomor_mesin" type="text" name="nomor_mesin" placeholder="" value="<?= $nomor_mesin; ?>">
                            <?= form_error('nomor_mesin', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="jumlah_sumbu">Jumlah Sumbu/AS</label>
                            <input class="form-control" id="jumlah_sumbu" type="text" name="jumlah_sumbu" placeholder="" value="<?= $jumlah_sumbu; ?>">
                            <?= form_error('jumlah_sumbu', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="jbb_penumpang">JBB/Penumpang</label>
                            <input class="form-control" id="jbb_penumpang" type="text" name="jbb_penumpang" placeholder="" value="<?= $jbb_penumpang; ?>">
                            <?= form_error('jbb_penumpang', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="harga_pembelian">Harga Pembelian</label>
                            <input class="form-control" id="harga_pembelian" type="text" name="harga_pembelian" placeholder="" value="<?= number_format($harga_pembelian); ?>">
                            <?= form_error('harga_pembelian', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="tahun_penyusutan">Tahun Penyusutan</label>
                            <input class="form-control" id="tahun_penyusutan" type="text" name="tahun_penyusutan" placeholder="" value="<?= $tahun_penyusutan; ?>">
                            <?= form_error('tahun_penyusutan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="keterangan">Keterangan</label>
                            <input class="form-control" id="keterangan" type="text" name="keterangan" placeholder="" value="<?= $keterangan; ?>">
                            <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <a href="<?php echo base_url('transaksi/kendaraan'); ?>"><button type="button" class="btn btn-secondary">Close</button></a>
                    <button type="submit" class="btn btn-success">Update</button>

                </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    function showPreview1(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview1");
            preview.src = src;
            preview.style.display = "block";
        }
    }

    function showPreview2(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview2");
            preview.src = src;
            preview.style.display = "block";
        }
    }

    function showPreview3(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview3");
            preview.src = src;
            preview.style.display = "block";
        }
    }

    function showPreview4(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview4");
            preview.src = src;
            preview.style.display = "block";
        }
    }
</script>