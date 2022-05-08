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
                            <th>Nama Penyedia/Vendor</th>
                            <th>Alamat</th>
                            <th>No Telpon</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($vendor as $sm) : ?>
                            <tr>
                                <td>
                                    <center><?= $i; ?></center>
                                </td>
                                <td><?= $sm['nama_vendor']; ?></td>
                                <td><?= $sm['alamat']; ?></td>
                                <td><?= $sm['no_telp']; ?></td>
                                <td>
                                    <center>
                                        <a href="#" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#edit<?= $sm['id']; ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="<?php echo site_url(); ?>master/delete_vendor/<?php echo $sm['id']; ?>" class="btn btn-danger btn-icon-split btn-sm tombol-hapus">
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/vendor'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" placeholder="Nama Vendor">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No Telpon">
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

<!-- Modal -->
<?php
foreach ($vendor as $i) :
    $id  = $i['id'];
    $nama_vendor  = $i['nama_vendor'];
    $alamat  = $i['alamat'];
    $no_telp  = $i['no_telp'];
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
                <form action="<?= base_url('master/update_vendor'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $id; ?>">
                            <input type="text" class="form-control" id="nama_vendor" value="<?php echo $nama_vendor; ?>" name="nama_vendor" placeholder="Nama Vendor">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="alamat" value="<?php echo $alamat; ?>" name="alamat" placeholder="Alamat">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="no_telp" value="<?php echo $no_telp; ?>" name="no_telp" placeholder="No Telpon">
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