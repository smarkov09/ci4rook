<?= $this->extend('layouts/dashb');
$this->section('title') ?> Show Hotel <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('hotels') ?>" class="btn btn-primary">Back to Hotels</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title">Show Hotel</h5>
                </div>
                <div class="card-body p-4">
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Hotel name</label>
                        <input type="text" class="form-control" disabled placeholder="Post Title" value="<?php echo trim($hotel['name']);?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>