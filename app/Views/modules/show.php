<?= $this->extend('layouts/dashb');
$this->section('title') ?> Show Module <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('modules') ?>" class="btn btn-primary">Back to Modules</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title">Show Module</h5>
                </div>
                <div class="card-body p-4">
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">Module name</label>
                        <input type="text" class="form-control" disabled placeholder="Post Title" value="<?php echo trim($module['name']);?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>