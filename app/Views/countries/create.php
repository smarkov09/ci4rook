<?= $this->extend('layouts/dashb');
$this->section('title') ?> Create Country <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
<?php $validation = \Config\Services::validation(); ?>
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('countries') ?>" class="btn btn-primary">Back to Countries</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="<?= base_url('countries') ?>">
                <?= csrf_field() ?>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Create Country</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Country Name</label>
                            <input type="text" class="form-control <?php if($validation->getError('countries_name')): ?>is-invalid<?php endif ?>" name="countries_name" placeholder="Country Name" value="<?php echo set_value('countries_name'); ?>"/>
                            <?php if ($validation->getError('countries_name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('countries_name') ?>
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