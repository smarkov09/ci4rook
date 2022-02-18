<?= $this->extend('layouts/dashb');
$this->section('title') ?> Show User <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('users') ?>" class="btn btn-primary">Back to Users</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title">Show User</h5>
                </div>
                <div class="card-body p-4">
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" disabled placeholder="User Name" value="<?php echo trim($user['name']);?>"/>
                    </div>
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">User Email</label>
                        <input type="text" class="form-control" disabled placeholder="User Email" value="<?php echo trim($user['email']);?>"/>
                    </div>
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">User Telephone</label>
                        <input type="text" class="form-control" disabled placeholder="User Telephone" value="<?php echo trim($user['phone']);?>"/>
                    </div>
                    <div class="form-group mb-3 has-validation">
                        <label class="form-label">User Type</label>
                        <input type="text" class="form-control" disabled placeholder="User Type" value="<?php echo trim($usertype);?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>