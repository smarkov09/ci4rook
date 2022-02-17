<?= $this->extend('layouts/dashb');
$this->section('title') ?> User types <?= $this->endSection() ?>

<?= $this->section('customStyles'); ?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?= $this->endSection(); ?>



<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Config <b><?= $utype['name']; ?></b> - Modules permissions</h1>

<?php var_dump($utype); ?>
<?php echo '<hr>'; ?>
<?php var_dump($ums); ?>

<div class="card shadow mb-4">
                        <div class="card-header py-3">

                          <form class="needs-validation" novalidate action="/usersmodules/check" method="post">
                            <input type="hidden" name="usertype_id" value="<?= $utype['id'] ?>">

                            <!--<h6 class="m-0 font-weight-bold text-primary">Posts</h6>-->
                            <div class="text-end">
                              <!--<a href="<?= base_url('usertypes/new') ?>" class="btn btn-primary">Save changes</a>-->
                              <button class="w-30 btn btn-primary" type="submit">Save changes</button>
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
      'class' => ''
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
      'class' => ''
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
      'class' => ''
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
      'class' => ''
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
      'class' => ''
    ];
    echo '<td class="">'.form_checkbox($cboxprint).' print</td>';
  }
}
?>
</table>
</div>



      <?= session()->getFlashdata('error') ?>
      <?= service('validation')->listErrors() ?>

      

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th scope="col">Module</th>
      <th scope="col">List</th>
      <th scope="col">Add</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      <th scope="col">Print</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Users</th>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="usrcb1" name="usrcbox[]" value="ucb1">
          <label class="form-check-label" for="usrcb1">list</label>
        </div>
      </td>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="usrcb2" name="usrcbox[]" value="ucb2">
          <label class="form-check-label" for="usrcb2">add</label>
        </div>
      </td>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="usrcb3" name="usrcbox[]" value="ucb3">
          <label class="form-check-label" for="usrcb3">edit</label>
        </div>
      </td>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="usrcb4" name="usrcbox[]" value="ucb4">
          <label class="form-check-label" for="usrcb4">delete</label>
        </div>
      </td>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="usrcb5" name="usrcbox[]" value="ucb5">
          <label class="form-check-label" for="usrcb5">print</label>
        </div>
      </td>
    </tr>
    <tr>
      <th scope="row">Hotels</th>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="htlcb1" name="htlcbox[]" value="hcb1">
          <label class="form-check-label" for="hcb1">print</label>
        </div>
      </td>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="htlcb2" name="htlcbox[]" value="hcb2">
          <label class="form-check-label" for="hcb2">print</label>
        </div>
      </td>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="htlcb3" name="htlcbox[]" value="hcb3">
          <label class="form-check-label" for="hcb3">print</label>
        </div>
      </td>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="htlcb4" name="htlcbox[]" value="hcb4">
          <label class="form-check-label" for="hcb4">print</label>
        </div>
      </td>
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="htlcb5" name="htlcbox[]" value="hcb5">
          <label class="form-check-label" for="hcb5">print</label>
        </div>
      </td>
    </tr>
    <tr>
      <th scope="row">Countries</th>
      <td>cty chkbx list</td>
      <td>cty chkbx add</td>
      <td>cty chkbx edit</td>
      <td>cty chkbx delete</td>
      <td>cty chkbx print</td>
    </tr>
    <tr>
      <th scope="row">Status</th>
      <td>sts chkbx list</td>
      <td>sts chkbx add</td>
      <td>sts chkbx edit</td>
      <td>sts chkbx delete</td>
      <td>sts chkbx print</td>
    </tr>
    <tr>
      <th scope="row">Leads</th>
      <td>lds chkbx list</td>
      <td>lds chkbx add</td>
      <td>lds chkbx edit</td>
      <td>lds chkbx delete</td>
      <td>lds chkbx print</td>
    </tr>
  </tbody>
</table>

</div>

        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="cb1" name="cbox[]" value="cb1">
          <label class="form-check-label" for="cb1">Shipping address is the same as my billing address</label>
        </div>

        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="cb2" name="cbox[]" value="cb2">
          <label class="form-check-label" for="cb2">Save this information for next time</label>
        </div>

        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="cb3" name="cbox[]" value="cb3">
          <label class="form-check-label" for="cb3">Save this information for next time</label>
        </div>

        <!--<button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>-->


      </form>



<?= $this->endSection(); ?>