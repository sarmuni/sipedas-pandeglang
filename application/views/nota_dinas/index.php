<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><?= $title; ?></h6>
        </div>
        <div class="card-body">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <!-- <a href="<?php echo base_url('transaksi/form_add_kendaraan'); ?>" class="btn btn-success btn-icon-split btn-sm"> -->
            <a href="" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#new">
                <span class="icon text-white-50">
                    <i class="fas fa-flag"></i>
                </span>
                <span class="text">Add New</span>
            </a>
            <a href="" class="btn btn-info btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-info-circle"></i>
                </span>
                <span class="text">Refresh</span>
            </a>
            <hr>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nota Dinas</th>
                            <th>Kepada</th>
                            <th>Dari</th>
                            <th>Tanggal</th>
                            <th>Perihal</th>
                            <th>No Polisi</th>
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($nota_dinas as $sm) : ?>
                            <tr>
                                <td>
                                    <center><?= $i; ?></center>
                                </td>
                                <td><?= $sm['nomor_nota_dinas']; ?></td>
                                <td><?= $sm['kepada']; ?></td>
                                <td><?= $sm['dari']; ?></td>
                                <td><?= $sm['tanggal_permohonan']; ?></td>
                                <td><?= $sm['perihal']; ?></td>
                                <td><?= $sm['no_polisi']; ?></td>
                                <td><a href="#" class="btn btn-default btn-icon-split btn-sm" data-toggle="modal" data-target="#viewpdf<?= $sm['id']; ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-print"></i>
                                        </span>
                                        <span class="text">PDF</span>
                                    </a></td>
                                <td>
                                    <center>

                                        <?php if ($sm['status'] == 2) { ?>
                                            <a href="#" class="btn btn-warning btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </span>
                                                <span class="text">Prosess</span>
                                            </a>
                                        <?php } elseif ($sm['status'] == 3) { ?>

                                            <a href="#" class="btn btn-success btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </span>
                                                <span class="text">Selesai</span>
                                            </a>
                                        <?php } else { ?>

                                            <!-- <a href="<?php echo site_url(); ?>transaksi/aprov_nota_dinas/<?php echo $sm['id']; ?>" class="btn btn-info btn-icon-split btn-sm aprov"> -->
                                            <a href="#" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#aprov<?= $sm['id']; ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </span>
                                                <span class="text">Approval</span>
                                            </a>
                                        <?php } ?>

                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php if ($sm['status'] == 2 || $sm['status'] == 3) { ?>

                                            <a target="_blank" href="<?php echo site_url(); ?>laporan/surat_pengantar/<?php echo $sm['id']; ?>" class="btn btn-success btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-print"></i>
                                                </span>
                                                <span class="text">Cetak</span>
                                            </a>

                                        <?php } else { ?>

                                            <a href="#" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#edit<?= $sm['id']; ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </a>
                                            <a href="<?php echo site_url(); ?>transaksi/delete_notadinas/<?php echo $sm['id']; ?>" class="btn btn-danger btn-icon-split btn-sm tombol-hapus">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Delete</span>
                                            </a>

                                        <?php } ?>
                                    </center>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->


<!-- Modal add -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="newLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('transaksi/nota_dinas'); ?>
            <div class="modal-body">

                <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <div class="form-group">
                        <select class="form-control" name="kode_opd" id="kode_opd">
                            <option value="">Pilih OPD/Instansi</option>
                            <?php foreach ($list_opd as $sm) : ?>
                                <option value="<?= $sm['kode_opd']; ?>"><?= $sm['nama_opd']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="kode_opd" name="kode_opd" value="<?= $opd['kode_opd']; ?>" placeholder="Kode OPD">
                        <input type="text" class="form-control" value="<?= $opd['nama_opd']; ?>" placeholder="Kode OPD" readonly>
                    </div>
                <?php } ?>


                <div class="form-group">
                    <input type="text" class="form-control" id="nomor_nota_dinas" name="nomor_nota_dinas" placeholder="Nota Dinas">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="kepada" name="kepada" placeholder="Kepada">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="dari" name="dari" placeholder="Dari">
                </div>

                <div class="form-group">
                    <input type="date" class="form-control" id="tanggal_permohonan" name="tanggal_permohonan" placeholder="tanggal_permohonan">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal">
                </div>
                <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <div class="mb-3">
                        <select class="form-control" id="no_polisi" name="no_polisi">
                            <option value="">Pilih Kendaraan</option>
                            <?php foreach ($kendaraan_opd as $p) : ?>
                                <option value="<?= $p['nomor_polisi']; ?>"><?= $p['nomor_polisi']; ?> - <?= $p['type']; ?> | <?= $p['nama_opd']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php } else { ?>
                    <div class="mb-3">
                        <select class="form-control" id="no_polisi" name="no_polisi">
                            <option value="">Pilih Kendaraan</option>
                            <?php foreach ($kendaraan_opd as $p) : ?>
                                <option value="<?= $p['nomor_polisi']; ?>"><?= $p['nomor_polisi']; ?> - <?= $p['type']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php } ?>


                <div class="form-group">
                    <textarea class="form-control" rows="7" id="rincian_penggantian" name="rincian_penggantian" placeholder="Rincian Penggantian"></textarea>
                </div>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" required id="dokumen" name="dokumen">
                    <label class="custom-file-label" for="dokumen">Upload Dokumen Nota Dinas Format PDF</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal View PDF-->
<?php
foreach ($nota_dinas as $i) :
    $id  = $i['id'];
    $dokumen  = $i['dokumen'];
?>
    <div class="modal fade" id="viewpdf<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="newLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLabel">View Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <iframe src="<?= base_url('./uploads/nota_dinas/' . $dokumen); ?>" height="900px" scrolling="auto"></iframe>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<!-- Modal edit -->
<?php
foreach ($nota_dinas as $i) :
    $id  = $i['id'];
    $kode_opd  = $i['kode_opd'];
    $nomor_nota_dinas  = $i['nomor_nota_dinas'];
    $kepada  = $i['kepada'];
    $dari  = $i['dari'];
    $tanggal_permohonan  = $i['tanggal_permohonan'];
    $perihal  = $i['perihal'];
    $no_polisi  = $i['no_polisi'];
    $rincian_penggantian  = $i['rincian_penggantian'];
    $dokumen  = $i['dokumen'];
?>
    <div class="modal fade" id="edit<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="newLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLabel">Edit Nota Dinas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open_multipart('transaksi/update_nota_dinas'); ?>
                <div class="modal-body">

                    <?php if ($this->session->userdata('role_id') == 1) { ?>
                        <div class="form-group">
                            <select class="form-control" name="kode_opd" id="kode_opd">
                                <option value="">Pilih OPD/Instansi</option>
                                <?php foreach ($list_opd as $sm) : ?>
                                    <?php if ($sm['kode_opd'] == $kode_opd) { ?>
                                        <option value="<?= $sm['kode_opd']; ?>" selected><?= $sm['nama_opd']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $sm['kode_opd']; ?>"><?= $sm['nama_opd']; ?></option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php } else { ?>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="kode_opd" name="kode_opd" value="<?= $opd['kode_opd']; ?>" placeholder="Kode OPD">
                            <input type="text" class="form-control" value="<?= $opd['nama_opd']; ?>" placeholder="Kode OPD" readonly>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $id; ?>">
                        <input type="text" class="form-control" id="nomor_nota_dinas" value="<?= $nomor_nota_dinas; ?>" name="nomor_nota_dinas" placeholder="Nota Dinas">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="kepada" name="kepada" value="<?= $kepada; ?>" placeholder="Kepada">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="dari" name="dari" value="<?= $dari; ?>" placeholder="Dari">
                    </div>

                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal_permohonan" value="<?= $tanggal_permohonan; ?>" name="tanggal_permohonan" placeholder="tanggal_permohonan">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="perihal" name="perihal" value="<?= $perihal; ?>" placeholder="Perihal">
                    </div>

                    <div class="mb-3">
                        <select class="form-control" id="no_polisi" name="no_polisi">
                            <option value="">Pilih Kendaraan</option>
                            <?php foreach ($kendaraan_opd as $p) : ?>
                                <?php if ($p['nomor_polisi'] == $no_polisi) : ?>
                                    <option value="<?= $p['nomor_polisi']; ?>" selected><?= $p['nomor_polisi']; ?> - <?= $p['type']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $p['nomor_polisi']; ?>"><?= $p['nomor_polisi']; ?> - <?= $p['type']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" rows="7" id="rincian_penggantian" name="rincian_penggantian" placeholder="Rincian Penggantian"><?= $rincian_penggantian; ?></textarea>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" required id="dokumen" name="dokumen" value="<?= $dokumen; ?>">
                        <label class="custom-file-label" for="dokumen">Upload Dokumen Nota Dinas Format PDF</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<!-- Modal Aprov -->
<?php
foreach ($nota_dinas as $i) :
    $id  = $i['id'];
    $nomor_nota_dinas  = $i['nomor_nota_dinas'];
    $kepada  = $i['kepada'];
    $dari  = $i['dari'];
    $tanggal_permohonan  = $i['tanggal_permohonan'];
    $perihal  = $i['perihal'];
    $no_polisi  = $i['no_polisi'];
    $rincian_penggantian  = $i['rincian_penggantian'];
?>
    <div class="modal fade" id="aprov<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="newLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLabel">Approval Nota Dinas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open_multipart('transaksi/approval_nota_dinas'); ?>
                <div class="modal-body">

                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-3">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Identitas Nota Dinas</div>
                                    <p>
                                    <table>
                                        <tr>
                                            <td>Nota Dinas</td>
                                            <td>:</td>
                                            <td><?= $nomor_nota_dinas; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kepada</td>
                                            <td>:</td>
                                            <td><?= $kepada; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Dari</td>
                                            <td>:</td>
                                            <td><?= $dari; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Permohonan</td>
                                            <td>:</td>
                                            <td><?= $tanggal_permohonan; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Perihal</td>
                                            <td>:</td>
                                            <td><?= $perihal; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Polisi</td>
                                            <td>:</td>
                                            <td><?= $no_polisi; ?></td>
                                        </tr>
                                        <tr>
                                            <td> Rincian Penggantian</td>
                                            <td>:</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><?= nl2br(str_replace(' ', ' ', htmlspecialchars($rincian_penggantian))); ?></td>
                                        </tr>
                                    </table>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $id; ?>">
                        <label for="status">Pilih Vendor / Penyedia</label>
                        <select class="form-control" id="vendor" name="vendor" required>
                            <option value=""></option>
                            <?php foreach ($vendor as $p) : ?>
                                <?php if ($p['id'] == $vendor) : ?>
                                    <option value="<?= $p['id']; ?>" selected><?= $p['nama_vendor']; ?> - <?= $p['alamat']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $p['id']; ?>"><?= $p['nama_vendor']; ?> - <?= $p['alamat']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Setujui</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>