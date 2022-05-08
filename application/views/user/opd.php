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

            <a href="#" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#new">
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
                            <th>Kode OPD</th>
                            <th>Nama Instansi</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($master_opd as $sm) : ?>
                            <tr>
                                <td>
                                    <center><?= $i; ?></center>
                                </td>
                                <td>
                                    <center><?= $sm['kode_opd']; ?></center>
                                </td>
                                <td><?= $sm['nama_opd']; ?></td>
                                <td><?= $sm['alamat']; ?></td>
                                <td><?= $sm['telpon']; ?></td>
                                <td>
                                    <center>
                                        <a href="#" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#edit<?php echo $sm['id']; ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="<?php echo site_url(); ?>user/delete_opd/<?php echo $sm['id']; ?>" class="btn btn-danger btn-icon-split btn-sm tombol-hapus">
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

<!-- Modal New -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="newLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newLabel">Add New OPD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/opd'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_opd" name="kode_opd" placeholder="Kode OPD">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_opd" name="nama_opd" placeholder="OPD / Nama Instansi">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="telpon" name="telpon" placeholder="Telpon">
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
foreach ($master_opd as $i) :
    $id  = $i['id'];
    $kode_opd  = $i['kode_opd'];
    $nama_opd  = $i['nama_opd'];
    $alamat  = $i['alamat'];
    $telpon  = $i['telpon'];
?>
    <div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="newLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/update_opd'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $id; ?>">
                            <input type="text" class="form-control" id="kode_opd" value="<?php echo $kode_opd; ?>" name="kode_opd" placeholder=" Kode OPD">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_opd" value="<?php echo $nama_opd; ?>" name="nama_opd" placeholder=" Nama OPD">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="alamat" value="<?php echo $alamat; ?>" name="alamat" placeholder=" Alamat">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="telpon" value="<?php echo $telpon; ?>" name="telpon" placeholder=" Telpon">
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
<?php endforeach; ?>