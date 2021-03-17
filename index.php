<?php
//index.php

$connect = new PDO("mysql:host=localhost;dbname=customer", "root", "");
$query = "SELECT * FROM customer ORDER BY customer_id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <title>Send Email </title>
</head>

<body>
    <div class="container">
        <h3 class="text-center">Send MAils </h3>
        <br>
        <div class="table-responive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Select</th>
                    <th>Action</th>
                </tr>
                <?php
                $count = 0;
                foreach ($result as $row) {
                    $count = $count + 1;
                    echo '
					<tr>
						<td>' . $row["customer_name"] . '</td>
						<td>' . $row["customer_email"] . '</td>
						<td>
							<input type="checkbox" name="single_select" class="single_select" data-email="' . $row["customer_email"] . '" data-name="' . $row["customer_name"] . '" />
						</td>
						<td>
						<button type="button" name="email_button" class="btn btn-info btn-xs email_button" id="' . $count . '" data-email="' . $row["customer_email"] . '" data-name="' . $row["customer_name"] . '" data-action="single">Send Single</button>
						</td>
					</tr>
					';
                }
                ?>
                <tr>
                    <td colspan="3"></td>
                    <td><button type="button" name="bulk_email" class="btn btn-info email_button" id="bulk_email" data-action="bulk">Send Bulk</button></td>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js "></script>
</body>

</html>
<script>
$(document).ready(function(){
	$('.email_button').click(function(){
		$(this).attr('disabled', 'disabled');
		var id  = $(this).attr("id");
		var action = $(this).data("action");
		var email_data = [];
		if(action == 'single')
		{
			email_data.push({
				email: $(this).data("email"),
				name: $(this).data("name")
			});
		}
		else
		{
			$('.single_select').each(function(){
				if($(this).prop("checked") == true)
				{
					email_data.push({
						email: $(this).data("email"),
						name: $(this).data('name')
					});
				} 
			});
		}

		$.ajax({
			url:"send_mail.php",
			method:"POST",
			data:{email_data:email_data},
			beforeSend:function(){
				$('#'+id).html('Sending...');
				$('#'+id).addClass('btn-danger');
			},
			success:function(data){
				if(data == 'ok')
				{
					$('#'+id).text('Success');
					$('#'+id).removeClass('btn-danger');
					$('#'+id).removeClass('btn-info');
					$('#'+id).addClass('btn-success');
				}
				else
				{
					$('#'+id).text(data);
				}
				$('#'+id).attr('disabled', false);
			}
		})

	});
});
</script> 