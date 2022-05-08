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
                            <th>Kode Akun</th>
                            <th>Nama Akun</th>
                            <th>Nama OPD/Instansi</th>
                            <th>Tahun</th>
                            <th>Total</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($master_anggaran as $sm) :
                            $total = $sm['jan'] + $sm['feb'] + $sm['mar'] + $sm['apr'] + $sm['mei'] + $sm['jun'] + $sm['jul'] + $sm['ags'] + $sm['sep'] + $sm['okt'] + $sm['nov'] + $sm['des'];
                        ?>
                            <tr>
                                <td>
                                    <center><?= $i; ?></center>
                                </td>
                                <td><?= $sm['kode_akun']; ?></td>
                                <td><?= $sm['nama_akun']; ?></td>
                                <td><?= $sm['nama_opd']; ?></td>
                                <td>
                                    <center><?= $sm['tahun_anggaran']; ?></center>
                                </td>
                                <td><?= number_format($total); ?></td>
                                <td>
                                    <center>
                                        <a href="" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#edit<?php echo $sm['id']; ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="<?php echo site_url(); ?>master/delete_anggaran/<?php echo $sm['id']; ?>" class="btn btn-danger btn-icon-split btn-sm tombol-hapus">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Delete</span>
                                        </a>
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



<!-- Modal -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="newLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newLabel">Add Anggaran OPD/Instansi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/anggaran'); ?>" method="post">
                <div class="modal-body">
                    <?php if ($this->session->userdata('role_id') == 1) { ?>
                        <div class="form-group">
                            <select name="kode_opd" id="kode_opd" class="form-control">
                                <option value="">Pilih OPD/Instansi</option>
                                <?php foreach ($list_opd as $op) : ?>
                                    <option value="<?= $op['kode_opd']; ?>"><?= $op['nama_opd']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php } else { ?>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="kode_opd" name="kode_opd" value="<?= $opd['kode_opd']; ?>">
                            <input type="text" class="form-control" value="<?= $opd['nama_opd']; ?>" placeholder="Kode OPD" readonly>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_akun" name="kode_akun" placeholder="Kode Akun">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_akun" name="nama_akun" placeholder="Nama Akun">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="tahun_anggaran" name="tahun_anggaran" placeholder="Tahun Anggaran">
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="jan" name="jan" placeholder="jan">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="feb" name="feb" placeholder="feb">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="mar" name="mar" placeholder="mar">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="apr" name="apr" placeholder="apr">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="mei" name="mei" placeholder="mei">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="jun" name="jun" placeholder="jun">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="jul" name="jul" placeholder="jul">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="ags" name="ags" placeholder="ags">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="sep" name="sep" placeholder="sep">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="okt" name="okt" placeholder="okt">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="nov" name="nov" placeholder="nov">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="des" name="des" placeholder="des">
                        </div>

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



<!-- Modal edit -->
<?php
foreach ($master_anggaran as $i) :
    $id  = $i['id'];
    $kode_opd  = $i['kode_opd'];
    $kode_akun  = $i['kode_akun'];
    $nama_akun  = $i['nama_akun'];
    $tahun_anggaran  = $i['tahun_anggaran'];
    $jan  = $i['jan'];
    $feb  = $i['feb'];
    $mar  = $i['mar'];
    $apr  = $i['apr'];
    $mei  = $i['mei'];
    $jun  = $i['jun'];
    $jul  = $i['jul'];
    $ags  = $i['ags'];
    $sep  = $i['sep'];
    $okt  = $i['okt'];
    $nov  = $i['nov'];
    $des  = $i['des'];
?>
    <div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="newLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLabel">Edit Anggaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('master/update_anggaran'); ?>" method="post">
                    <div class="modal-body">
                        <?php if ($this->session->userdata('role_id') == 1) { ?>
                            <div class="form-group">
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
                            </div>
                        <?php } else { ?>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="kode_opd" name="kode_opd" value="<?= $opd['kode_opd']; ?>">
                                <input type="text" class="form-control" value="<?= $opd['nama_opd']; ?>" placeholder="Kode OPD" readonly>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $id; ?>">
                            <input type="text" class="form-control" id="kode_akun" value="<?= $kode_akun; ?>" name="kode_akun" placeholder="Kode Akun">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_akun" value="<?= $nama_akun; ?>" name="nama_akun" placeholder="Nama Akun">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="tahun_anggaran" value="<?= $tahun_anggaran; ?>" name="tahun_anggaran" placeholder="Tahun Anggaran">
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="jan" name="jan" placeholder="jan" value="<?= number_format($jan); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="feb" name="feb" placeholder="feb" value="<?= number_format($feb); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="mar" name="mar" placeholder="mar" value="<?= number_format($mar); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="apr" name="apr" placeholder="apr" value="<?= number_format($apr); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="mei" name="mei" placeholder="mei" value="<?= number_format($mei); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="jun" name="jun" placeholder="jun" value="<?= number_format($jun); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="jul" name="jul" placeholder="jul" value="<?= number_format($jul); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="ags" name="ags" placeholder="ags" value="<?= number_format($ags); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="sep" name="sep" placeholder="sep" value="<?= number_format($sep); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="okt" name="okt" placeholder="okt" value="<?= number_format($okt); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="nov" name="nov" placeholder="nov" value="<?= number_format($nov); ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="des" name="des" placeholder="des" value="<?= number_format($des); ?>">
                            </div>

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