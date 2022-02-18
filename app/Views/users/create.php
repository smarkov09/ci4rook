<?= $this->extend('layouts/dashb');
$this->section('title') ?> Create User <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
<?php $validation = \Config\Services::validation(); ?>
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('users') ?>" class="btn btn-primary">Back to Users</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="<?= base_url('users') ?>">
                <?= csrf_field() ?>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Create User</h5>
                    </div>
                    <div class="card-body p-4">
                    <div class="form-group mb-3 has-validation">
                            <label class="form-label">User Type</label>
                            <select name="usertype" id="usertype" class="form-control input-lg">
                                <option value="">Select User type</option>
                                <?php
                                foreach($usertype as $row)
                                {
                                    echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">User Name</label>
                            <input type="text" class="form-control <?php if($validation->getError('name')): ?>is-invalid<?php endif ?>" name="name" placeholder="User Name" value="<?php echo set_value('name'); ?>" required/>
                            <?php if ($validation->getError('name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>                                
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">User Email</label>
                            <input type="email" class="form-control <?php if($validation->getError('email')): ?>is-invalid<?php endif ?>" name="email" placeholder="User Email" value="<?php echo set_value('email'); ?>" required/>
                            <?php if ($validation->getError('email')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>                                
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3 has-validation">
                                <label for="password"> Password </label>
                                <input type="password" class="form-control <?php if ($validation->getError('password')) : ?>is-invalid <?php endif ?>" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" />
                                <?php if ($validation->getError('password')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">User Telephone</label>
                            <input type="text" class="form-control <?php if($validation->getError('phone')): ?>is-invalid<?php endif ?>" name="phone" placeholder="User Telephone" value="<?php echo set_value('phone'); ?>" required/>
                            <?php if ($validation->getError('phone')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('phone') ?>
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