<?= $this->extend('layouts/dashb');
$this->section('title') ?> User types <?= $this->endSection() ?>

<?= $this->section('customStyles'); ?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection(); ?>



<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Config <b><?= $utype['name']; ?></b> - Modules permissions</h1>

<?php //var_dump($utype); ?>
<?php //echo '<hr>'; ?>
<?php //var_dump($ums); ?>

<div class="card shadow mb-4">
                        <div class="card-header py-3">

                          <form class="needs-validation" novalidate action="" method="post">
                            <input type="hidden" name="usertype_id" value="<?= $utype['id'] ?>">

                            <!--<h6 class="m-0 font-weight-bold text-primary">Posts</h6>-->
                            <div class="text-end">
                              <!--<a href="<?= base_url('usertypes/new') ?>" class="btn btn-primary">Save changes</a>-->
                              <!--<button class="w-30 btn btn-primary" type="submit">Save changes</button>-->
                              <a href="<?= base_url('usertypes') ?>" class="btn btn-primary">Back to User types</a>
                            </div>
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

      <?= session()->getFlashdata('error') ?>
      <?= service('validation')->listErrors() ?>

<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Module</th>
      <th>Read</th>
      <th>Create</th>
      <th>Update</th>
      <th>Delete</th>
      <th>Print</th>
    </tr>
  </thead>
<?php
$ctrl = 1;
if ($ums) {
  foreach ($ums as $data) {
    echo '<tr>';
    echo '<td><b>'.$data->module_name.'</b></td>';
    $cboxread = [
      'id' => $data->module_id.'_'.$ctrl.'rprop[]',
      'name' => $data->module_id.'_'.$ctrl.'rprop[]',
      'value' => $data->read,
      'checked' => $data->read ? true : false,
      'data-id' => $data->id,
      'data-field' => 'read',
      'class' => 'rockbottom'
    ];
    echo '<td class="">'.form_checkbox($cboxread).' read</td>';
    $ctrl++;
    $cboxcreate = [
      'id' => $data->module_id.'_'.$ctrl.'cprop[]',
      'name' => $data->module_id.'_'.$ctrl.'cprop[]',
      'value' => $data->create,
      'checked' => $data->create ? true : false,
      'data-id' => $data->id,
      'data-field' => 'create',
      'class' => 'rockbottom'
    ];
    echo '<td class="">'.form_checkbox($cboxcreate).' create</td>';
    $ctrl++;
    $cboxupdate = [
      'id' => $data->module_id.'_'.$ctrl.'uprop[]',
      'name' => $data->module_id.'_'.$ctrl.'uprop[]',
      'value' => $data->update,
      'checked' => $data->update ? true : false,
      'data-id' => $data->id,
      'data-field' => 'update',
      'class' => 'rockbottom'
    ];
    echo '<td class="">'.form_checkbox($cboxupdate).' update</td>';
    $ctrl++;
    $cboxdelete = [
      'id' => $data->module_id.'_'.$ctrl.'dprop[]',
      'name' => $data->module_id.'_'.$ctrl.'dprop[]',
      'value' => $data->delete,
      'checked' => $data->delete ? true : false,
      'data-id' => $data->id,
      'data-field' => 'delete',
      'class' => 'rockbottom'
    ];
    echo '<td class="">'.form_checkbox($cboxdelete).' delete</td>';
    $ctrl++;
    $cboxprint = [
      'id' => $data->module_id.'_'.$ctrl.'pprop[]',
      'name' => $data->module_id.'_'.$ctrl.'pprop[]',
      'value' => $data->print,
      'checked' => $data->print ? true : false,
      'data-id' => $data->id,
      'data-field' => 'print',
      'class' => 'rockbottom'
    ];
    echo '<td class="">'.form_checkbox($cboxprint).' print</td>';
  }
}
?>
</table>
</div>




      </form>



<?= $this->endSection(); ?>


<?= $this->section('pageLevelCustomScripts') ?>
<script>
    $(".rockbottom").click(function () {
      var umid = $(this).attr("data-id");
      var umcol = $(this).attr("data-field");
      var umval = $(this).attr("value");
      if (umval == 0) {
        umval = 1;
      } else {
        umval = 0;
      }
      console.log(umid);
      console.log(umcol);
      console.log(umval);
      /*alert("Clicked Rockbottom! dID =" + $(this).attr("data-id") + " colID = " + $(this).attr("data-field") + " umVAL = " + umval);*/
      $.ajax({
        type: 'POST',
        data: {
          um_id: umid,
          um_col: umcol,
          um_val: umval
        },
        url: "<?php echo base_url('usertypes/update_permission')?>",
        success: function(msg) {
          if (msg == 'YES') {
              window.location.reload();
          }
        },
        error: function() {
          alert("ERROR");
        }
      });
    });
    </script>
<?= $this->endSection(); ?>