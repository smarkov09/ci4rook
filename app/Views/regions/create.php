<?= $this->extend('layouts/dashb');
$this->section('title') ?> Create Country <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
<?php $validation = \Config\Services::validation(); ?>
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('regions') ?>" class="btn btn-primary">Back to Regions</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="<?= base_url('regions') ?>">
                <?= csrf_field() ?>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Create Region</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Region Name</label>
                            <input type="text" class="form-control <?php if($validation->getError('region_name')): ?>is-invalid<?php endif ?>" name="region_name" placeholder="Region Name" value="<?php echo set_value('region_name'); ?>"/>
                            <?php if ($validation->getError('region_name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('region_name') ?>
                                </div>                                
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>