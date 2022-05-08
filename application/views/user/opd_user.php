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

            <div class="row">
                <div class="col-lg-8">

                    <?= form_open_multipart('user/opd'); ?>
                    <div class="form-group row">
                        <label for="kode_opd" class="col-sm-2 col-form-label">Kode OPD</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $opd['id']; ?>" readonly>
                            <input type="text" class="form-control" id="kode_opd" name="kode_opd" value="<?= $opd['kode_opd']; ?>" readonly>
                            <?= form_error('kode_opd', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_opd" class="col-sm-2 col-form-label">Nama OPD/Instansi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_opd" name="nama_opd" value="<?= $opd['nama_opd']; ?>" readonly>
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $opd['alamat']; ?>">
                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telpon" class="col-sm-2 col-form-label">Telpon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telpon" name="telpon" value="<?= $opd['telpon']; ?>">
                            <?= form_error('telpon', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

</div>
<!-- End of Main Content -->