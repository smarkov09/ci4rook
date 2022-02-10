<?= $this->extend('layouts/dashb');
$this->section('title') ?> Create City <?= $this->endSection() ?>
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
            <form method="POST" action="<?= base_url('cities') ?>">
                <?= csrf_field() ?>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Create City</h5>
                    </div>
                    <div class="card-body p-4">
                    <div class="form-group mb-3 has-validation">
                            <label class="form-label">Country</label>
                            <select name="region_id" id="region" class="form-control input-lg">
                                <option value="">Select Region</option>
                                <?php
                                foreach($region as $row)
                                {
                                    echo '<option value="'.$row["region_id"].'">'.$row["region_name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">City Name</label>
                            <input type="text" class="form-control <?php if($validation->getError('city_name')): ?>is-invalid<?php endif ?>" name="city_name" placeholder="city Name" value="<?php echo set_value('city_name'); ?>" required/>
                            <?php if ($validation->getError('city_name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('city_name') ?>
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


<?= $this->section('pageLevelCustomScripts') ?>

<?= $this->endSection(); ?>