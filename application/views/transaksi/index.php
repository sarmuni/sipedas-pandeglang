<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><?= $title; ?></h6>
        </div>

        <div class="card-body">
            <div class="col-lg">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <?= $this->session->flashdata('message'); ?>

                <a href="<?php echo base_url('transaksi/form_add_transaksi'); ?>" class="btn btn-success btn-icon-split btn-sm">
                    <!-- <a href="" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#new"> -->
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
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                <center>No</center>
                            </th>
                            <th>
                                <center>Kode Transaksi</center>
                            </th>
                            <th>
                                <center>Nomor Polisi</center>
                            </th>
                            <th>
                                <center>Tanggal Perawatan</center>
                            </th>
                            <th>
                                <center>Jenis Perawatan</center>
                            </th>
                            <th>
                                <center>Kilometer</center>
                            </th>
                            <th>
                                <center>Jumlah</center>
                            </th>
                            <th>
                                <center>Action</center>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($transaksi as $sm) : ?>
                            <tr>
                                <td>
                                    <center><?= $i; ?></center>
                                </td>
                                <td>
                                    <a href="<?php echo site_url(); ?>laporan/invoice/<?php echo $sm['id']; ?>" target="_blank">
                                        <center><?= $sm['code']; ?></center>
                                    </a>
                                </td>
                                <td>
                                    <center><?= $sm['nomor_polisi']; ?></center>
                                </td>
                                <td>
                                    <center><?= $sm['tanggal_perawatan']; ?></center>
                                </td>
                                <td><?= $sm['nama_jenis_perawatan']; ?></td>
                                <td>
                                    <center><?= $sm['kilometer_kendaraan']; ?></center>
                                </td>
                                <td>
                                    <center><?= number_format($sm['jumlah']); ?></center>
                                </td>
                                <td>
                                    <center>
                                        <a href="<?php echo site_url(); ?>transaksi/form_edit_transaksi/<?php echo $sm['id']; ?>/<?php echo $sm['code']; ?>" class="btn btn-warning btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="<?php echo site_url(); ?>transaksi/delete/<?php echo $sm['id']; ?>/<?php echo $sm['code']; ?>/<?php echo $sm['nomor_polisi']; ?>" class="btn btn-danger btn-icon-split btn-sm tombol-hapus">
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