<?= $this->extend('layouts/dashb');
$this->section('title') ?> Create Hotel <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
<?php $validation = \Config\Services::validation(); ?>
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('hotels') ?>" class="btn btn-primary">Back to Hotels</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="<?= base_url('hotels') ?>">
                <?= csrf_field() ?>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Create Hotel</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Hotel Name</label>
                            <input type="text" class="form-control <?php if($validation->getError('name')): ?>is-invalid<?php endif ?>" name="name" placeholder="Hotel name" value="<?php echo set_value('name'); ?> "/>
                            <?php if ($validation->getError('name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
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