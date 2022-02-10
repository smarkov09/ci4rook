
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <title>Codeigniter 4 Dynamic Dependent Dropdown with Ajax</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4 mb-4">Codeigniter 4 Dynamic Dependent Dropdown with Ajax</h2>
        <span id="message"></span>
        <div class="card">
            <div class="card-header">Codeigniter 4 Dynamic Dependent Dropdown with Ajax</div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-6">
                        <div class="form-group">
                            <select name="country" id="country" class="form-control input-lg">
                                <option value="">Select Country</option>
                                <?php
                                foreach($country as $row)
                                {
                                    echo '<option value="'.$row["country_id"].'">'.$row["country_name"].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="state" id="state" class="form-control input-lg">
                                <option value="">Select State</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="city" id="city" class="form-control input-lg">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</body>
</html>

<script>

$(document).ready(function(){

    $('#country').change(function(){

        var country_id = $('#country').val();

        var action = 'get_state';

        if(country_id != '')
        {
            $.ajax({
                url:"<?php echo base_url('/dynamicdependent/action'); ?>",
                method:"POST",
                data:{country_id:country_id, action:action},
                dataType:"JSON",
                success:function(data)
                {
                    var html = '<option value="">Select State</option>';

                    for(var count = 0; count < data.length; count++)
                    {

                        html += '<option value="'+data[count].state_id+'">'+data[count].state_name+'</option>';

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

