<?= $this->extend('layouts/dashb');
$this->section('title') ?> Create Region <?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container">
<?php $validation = \Config\Services::validation(); ?>
    <div class="row py-4">
        <div class="col-xl-12 text-end">
            <a href="<?= base_url('regions') ?>" class="btn btn-primary">Back to Regions</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 m-auto">
            <form method="POST" action="<?= base_url('regions') ?>">
                <?= csrf_field() ?>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title">Create Region</h5>
                    </div>
                    <div class="card-body p-4">
                    <div class="form-group mb-3 has-validation">
                            <label class="form-label">Country</label>
                            <select name="country_id" id="country" class="form-control input-lg">
                                <option value="">Select Country</option>
                                <?php
                                foreach($country as $row)
                                {
                                    echo '<option value="'.$row["countries_id"].'">'.$row["countries_name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 has-validation">
                            <label class="form-label">Region Name</label>
                            <input type="text" class="form-control <?php if($validation->getError('region_name')): ?>is-invalid<?php endif ?>" name="region_name" placeholder="Region Name" value="<?php echo set_value('region_name'); ?>" required/>
                            <?php if ($validation->getError('region_name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('region_name') ?>
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
<script>

$(document).ready(function(){

    $('#country').change(function(){

        var country_id = $('#country').val();

        var action = 'get_country';

        if(country_id != '')
        {
            $.ajax({
                url:"<?php echo base_url('/regioncontroller/action'); ?>",
                method:"POST",
                data:{country_id:country_id, action:action},
                dataType:"JSON",
                success:function(data)
                {
                    var html = '<option value="">Select Country</option>';

                    for(var count = 0; count < data.length; count++)
                    {

                        html += '<option value="'+data[count].countries_id+'">'+data[count].countries_name+'</option>';

                    }

                    $('#state').html(html);
                }
            });
        }
        else
        {
            $('#state').val('');
        }
        $('#city').val('');
    });

    $('#state').change(function(){

        var state_id = $('#state').val();

        var action = 'get_city';

        if(state_id != '')
        {
            $.ajax({
                url:"<?php echo base_url('/dynamicdependent/action'); ?>",
                method:"POST",
                data:{state_id:state_id, action:action},
                dataType:"JSON",
                success:function(data)
                {
                    var html = '<option value="">Select City</option>';

                    for(var count = 0; count < data.length; count++)
                    {
                        html += '<option value="'+data[count].city_id+'">'+data[count].city_name+'</option>';
                    }

                    $('#city').html(html);
                }
            });
        }
        else
        {
            $('#city').val('');
        }

    });

});

</script>
<?= $this->endSection(); ?>