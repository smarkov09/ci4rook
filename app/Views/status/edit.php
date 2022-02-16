<?= $this->extend('layouts/dashb');
$this->section('title') ?> Create Status <?= $this->endSection() ?>

<?= $this->section('customStyles') ?>
<!-- wheel color picker -->
<link type="text/css" rel="stylesheet" href="<?= base_url() ?>/js/wheelcolorpicker.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
<?php $validation = \Config\Services::validation(); ?>

    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('status') ?>" class="btn btn-primary">Back to Status</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="<?= base_url('status/'.$state['id']) ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT"/>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Update Status</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Status Title</label>
                            <input type="text" class="form-control <?php if($validation->getError('name')): ?>is-invalid<?php endif ?>" name="name" placeholder="Status name" value="<?php if($state['name']): echo $state['name']; else: set_value('name'); endif ?>"/>
                            <?php if ($validation->getError('name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>                                
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Color</label>                            
                            <input type="text" data-wheelcolorpicker="" data-wcp-preview="true" id="color" class="form-control <?php if($validation->getError('color')): ?>is-invalid<?php endif ?>" name="color" placeholder="" value="<?php if($state['color']): echo $state['color']; else: set_value('color'); endif ?>" style="background-color: #<?= $state['color'] ?>;"/>
                            <?php if ($validation->getError('color')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('color') ?>
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

<?= $this->section('pageLevelCustomScripts') ?>
<script type="text/javascript" src="<?= base_url() ?>/js/jquery.wheelcolorpicker.js"></script>

<?= $this->endSection() ?>