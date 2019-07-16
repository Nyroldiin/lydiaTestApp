<?php

require_once 'conf/config.php';
require_once 'conf/lydiaApi.php';
require_once 'conf/bdd.php';

?><!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Donation request</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/main.css">
	</head>
	<body class="text-center">
		<div class="container">
			<?php if($_GET['p'] == 'admin')
			{

				echo '<table class="table lydiaTable">
  						<thead class="thead-dark">
    						<tr>
						      	<th scope="col">#</th>
						      	<th scope="col">Name</th>
						      	<th scope="col">Last</th>
						      	<th scope="col">Email</th>
						      	<th scope="col">Info</th>
    						</tr>
  						</thead>
  					<tbody>';

				$sql = get_db()->prepare("SELECT * FROM transaction ORDER BY date_time DESC");
  				$sql -> execute();

   				while($data_sql = $sql->fetch()) {
      				echo '<tr><td>'.$data_sql->id.'</td><td>'.$data_sql->name.'</td><td>'.$data_sql->lastname.'</td><td>'.$data_sql->email.'</td><td id="id'.$data_sql->request_uuid.'" class="uuidInfo" data-uuid="'.$data_sql->request_uuid.'"></td></tr>';
				}

				echo '</tbody></table>';

			}
			else{
			?>
			<div class="row justify-content-md-center">
				<div class="col col-lg-4">
					<img class="mb-4" src="assets/img/logo-lydia.png" alt="Lydia Logo">
					<h1 class="h3 mb-3 font-weight-normal">Information for the payment request</h1>
				</div>
			</div>
			<div class="row justify-content-md-center">
				<div class="errorreponse"></div>
				<div class="flip-div">
		  			<div class="flip-div-inner">
		   				<div class="flip-div-front">
							<form id="formSend" class="form-signin">
								
								<label for="inputName" class="sr-only">Name</label>
								<input type="text" id="inputName" class="form-control inputFirst" placeholder="Name" name="name" required autofocus>
								<label for="inputLastName" class="sr-only">Last name</label>
								<input type="text" id="inputLastName" class="form-control inputMiddle" placeholder="Last Name" name="lastname" required>
								<label for="inputEmail" class="sr-only">Email address</label>
								<input type="email" id="inputEmail" class="form-control inputEnd" placeholder="Email address" name="email" required>
								<button id="btnSend" class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
								
							</form>
						</div>
		    			<div class="flip-div-back">
					      	<div class="circle-loader">
		  						<div class="checkmark draw"></div>
							</div>
							<div class="validreponse"></div>
							<a class="newTrans" href="#">New transaction</a>
		    			</div>
		  			</div>
				</div>
			</div>
			<?php } ?>
			<div class="row justify-content-md-center">
				<div class="col col-lg-4">
					<p class="text-muted"><?= ($_GET['p'] == 'admin') ? '<a href="/">Front-office</a>' : '<a href="admin.html">Back-office</a>'; ?> - Nyro &copy; 2019</p>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>
	</body>
</html>
