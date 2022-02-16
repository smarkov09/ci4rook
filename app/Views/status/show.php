<?= $this->extend('layouts/dashb');
$this->section('title') ?> Show Status <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('status') ?>" class="btn btn-primary">Back to Status</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title">Show Status</h5>
                </div>
                <div class="card-body p-4">
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Status Title</label>
                        <input type="text" class="form-control" disabled placeholder="Status Title" value="<?php echo trim($state['name']);?>"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Color</label>
                        <input type="text" class="form-control" disabled placeholder="Color" value="<?php echo trim($state['color']);?>" style="background-color: #<?= $state['color'] ?>;"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>