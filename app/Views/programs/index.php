<?= $this->extend('layouts/dashb');
$this->section('title') ?> Programs <?= $this->endSection() ?>

<?= $this->section('customStyles'); ?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection(); ?>



<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Programs</h1>

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!--<h6 class="m-0 font-weight-bold text-primary">Posts</h6>-->
                            <div class="text-end"><a href="<?= base_url('programs/new') ?>" class="btn btn-primary">Add Program</a></div>
                            <?php
                        if(session()->getFlashdata('success')):?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?php echo session()->getFlashdata('success') ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        <?php elseif(session()->getFlashdata('failed')):?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?php echo session()->getFlashdata('failed') ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                    <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Program name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Program name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        if (count($programs) > 0):
                                            foreach ($programs as $program): ?>
                                                <tr>
                                                    <td><?= $program['id'] ?></td>
                                                    <td><?= $program['name'] ?></td>
                                                    <td class="d-flex">
                                                        <a href="<?= base_url('programs/'.$program['id']) ?>" class="btn btn-sm btn-info mx-1" title="Show"><i class="fas fa-info-circle"></i></a>
                                                        <a href="<?= base_url('programs/edit/'.$program['id']) ?>" class="btn btn-sm btn-success mx-1" title="Edit"><i class="fas fa-edit"></i></a>
                                                        <form class="display-none" method="post" action="<?= base_url('programs/'.$program['id'])?>" id="postDeleteForm<?=$program['id']?>">
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                            <a href="javascript:void(0)" onclick="deletePost('postDeleteForm<?=$program['id']?>')" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else: ?>
                                            <tr rowspan="1">
                                                <td colspan="4">
                                                    <h6 class="text-danger text-center">No data found</h6>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
   
   

   <script>
    function deletePost(formId) {
        var confirm = window.confirm('Do you want to delete this program?');
        if(confirm == true) {
            document.getElementById(formId).submit();
        }
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('pageLevelPlugins') ?>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('pageLevelCustomScripts') ?>
<script src="js/demo/datatables-demo.js"></script>
<?= $this->endSection(); ?>