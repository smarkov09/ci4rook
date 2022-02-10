<?= $this->extend('layouts/dashb');
$this->section('title') ?> Edit City <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
<?php $validation = \Config\Services::validation(); ?>

    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('cities') ?>" class="btn btn-primary">Back to Cities</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="<?= base_url('cities/'.$city['city_id']) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT"/>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Update City</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">City Name</label>
                            <input type="text" class="form-control <?php if($validation->getError('city_name')): ?>is-invalid<?php endif ?>" name="city_name" placeholder="city Name" value="<?php if($city['city_name']): echo $city['city_name']; else: set_value('city_name'); endif ?>"/>
                            <?php if ($validation->getError('city_name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('city_name') ?>
                                </div>                                
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>