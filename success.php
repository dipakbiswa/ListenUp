<?php
include 'dbcon.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
session_start();
$email = $_SESSION['email'];
$name = $_SESSION['username'];
//$date = date();
if (isset($_GET['tid']) and isset($_GET['plan']) and isset($_GET['user_id'])) {
	$tid = $_GET['tid'];
	$plan = $_GET['plan'];
	$user_id = $_GET['user_id'];
	if ($plan == 1) {
		$today_date = date("Y/m/d"); //Today's Date
		$date = new DateTime($today_date); // Y-m-d/ Creating Date object
		$date->add(new DateInterval('P30D')); //Adding 30 days
		$expire_date = $date->format('Y-m-d'); //Geting expirey date

		//Changing Date formate for mysql
		$today = date("Y-m-d", strtotime($today_date));
		$last_date = date("Y-m-d", strtotime($expire_date));

		$update_query = "update user set plan = 1, plan_expire = '$expire_date' WHERE id = '$user_id'";
		$insert_payment_details_query = "insert INTO `payment`(`transaction_id`, `amount`, `plan_name`, `user_id`, `date`, `next_payment`) VALUES ('$tid','199','Monthly Plan','$user_id','$today','$last_date')";
		$update_query_run = mysqli_query($conn, $update_query);
		$insert_payment_details_query_run = mysqli_query($conn, $insert_payment_details_query);
		if ($update_query_run and $insert_payment_details_query_run and sendMail($email, $name, $tid, "Monthly Plan", 199, $today, $last_date)) {
			$status = "Payment success! Your account upgraded to montyly plan, Your Expire Date is: " . $expire_date . " . Click on continue.<br>";
			//echo "<a href='logout.php'><button>Continue</button></a>";
		}
	}
	if ($plan == 2) {
		$today_date = date("Y/m/d"); //Today's Date
		$date = new DateTime($today_date); // Y-m-d/ Creating Date object
		$date->add(new DateInterval('P365D')); //Adding 365 days
		$expire_date = $date->format('Y-m-d'); //Geting expirey date


		//Changing Date formate for mysql
		$today = date("Y-m-d", strtotime($today_date));
		$last_date = date("Y-m-d", strtotime($expire_date));

		$update_query = "update user set plan = 2, plan_expire = '$expire_date' WHERE id = '$user_id'";
		$insert_payment_details_query = "insert INTO `payment`(`transaction_id`, `amount`, `plan_name`, `user_id`, `date`, `next_payment`) VALUES ('$tid','365','Yearly Plan','$user_id','$today','$last_date')";
		$insert_payment_details_query_run = mysqli_query($conn, $insert_payment_details_query);
		$update_query_run = mysqli_query($conn, $update_query);
		if ($update_query_run and $insert_payment_details_query_run and sendMail($email, $name, $tid, "Yearly Plan", 365, $today, $last_date)) {
			$status = "Payment success! Your account upgraded to yearly plan, Your Expire Date is: " . $expire_date . " . Click on continue.<br>";
			//echo "<a href='logout.php'><button>Continue</button></a>";
		}
	}

}


function sendMail($email, $name, $tid, $plan, $amount, $date, $expire_date)
{
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';
  require 'PHPMailer/Exception.php';

  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.hostinger.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'inbox@toolify.online'; //SMTP username
    $mail->Password = 'ddDD96147420##'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('inbox@toolify.online', 'ListenUp');
    $mail->addAddress($email, $name); //Add a recipient


    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Plan purchase successful | ListenUp';
    $mail->Body = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <title>Document</title>
        <style>
            *{
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
        <center>
            <h3>Thank you for being a member</h3>
            <img src='https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjCEHbKhJx6AAtoNIZDQLaJh_YRF0PVaPRzCv5LgH_vmrLZWWK943QBpOWLnHsny-b5sM-a2_GX5PAZdyz-D6nV0fY2nSIvgOUoHWvpn-3WgXpztQ5NnfKEwzk1N883QMBBBAyHPWsTM3pItdmqC2y4GOZ4sFd6POj-U_kog_nyZc3B9rSx0wCLSAYo5HbC/s320/logo.png' width='150px' height='150px'>
            <p><b>Hello $name, Thanks for being buying $plan!</b></p>
            <p>Here's your details ⬇️</p>
            <table border='1'>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Plan</th>
                    <th>Transaction Id</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Expire Date</th>
                </tr>
                <tr>
                    <th>$name</th>
                    <th>$email</th>
                    <th>$plan</th>
                    <th>$tid</th>
                    <th>₹$amount</th>
                    <th>$date</th>
                    <th>$expire_date</th>
                </tr>
            </table><br>
            <a href='http://localhost/audiobook2/login.php' style='background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                border-radius:10px;
                display: inline-block;
                font-size: 16px;'>Login Now</a>
        </center>
    </body>
    </html>";

    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Success</title>
	<style>
		.card {
			overflow: hidden;
			position: relative;
			text-align: left;
			border-radius: 0.5rem;
			max-width: 290px;
			box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
			background-color: #fff;

			margin: auto;
			width: 50%;
			padding: 10px;
		}

		.dismiss {
			position: absolute;
			right: 10px;
			top: 10px;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 0.5rem 1rem;
			background-color: #fff;
			color: black;
			border: 2px solid #D1D5DB;
			font-size: 1rem;
			font-weight: 300;
			width: 30px;
			height: 30px;
			border-radius: 7px;
			transition: .3s ease;
		}

		.dismiss:hover {
			background-color: #ee0d0d;
			border: 2px solid #ee0d0d;
			color: #fff;
		}

		.header {
			padding: 1.25rem 1rem 1rem 1rem;
		}

		.image {
			display: flex;
			margin-left: auto;
			margin-right: auto;
			background-color: #e2feee;
			flex-shrink: 0;
			justify-content: center;
			align-items: center;
			width: 3rem;
			height: 3rem;
			border-radius: 9999px;
			animation: animate .6s linear alternate-reverse infinite;
			transition: .6s ease;
		}

		.image svg {
			color: #0afa2a;
			width: 2rem;
			height: 2rem;
		}

		.content {
			margin-top: 0.75rem;
			text-align: center;
		}

		.title {
			color: #066e29;
			font-size: 1rem;
			font-weight: 600;
			line-height: 1.5rem;
		}

		.message {
			margin-top: 0.5rem;
			color: #595b5f;
			font-size: 0.875rem;
			line-height: 1.25rem;
		}

		.actions {
			margin: 0.75rem 1rem;
		}

		.history {
			display: inline-flex;
			padding: 0.5rem 1rem;
			background-color: #1aa06d;
			color: #ffffff;
			font-size: 1rem;
			line-height: 1.5rem;
			font-weight: 500;
			justify-content: center;
			width: 100%;
			border-radius: 0.375rem;
			border: none;
			box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
		}

		.track {
			display: inline-flex;
			margin-top: 0.75rem;
			padding: 0.5rem 1rem;
			color: #242525;
			font-size: 1rem;
			line-height: 1.5rem;
			font-weight: 500;
			justify-content: center;
			width: 100%;
			border-radius: 0.375rem;
			border: 1px solid #D1D5DB;
			background-color: #fff;
			box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
		}

		@keyframes animate {
			from {
				transform: scale(1);
			}

			to {
				transform: scale(1.09);
			}
		}

		.center {}
	</style>
</head>

<body>
	<div class="center">
		<div class="card">
			<div class="header">
				<div class="image">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
						<g stroke-width="0" id="SVGRepo_bgCarrier"></g>
						<g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
						<g id="SVGRepo_iconCarrier">
							<path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#000000"
								d="M20 7L9.00004 18L3.99994 13"></path>
						</g>
					</svg>
				</div>
				<div class="content">
					<span class="title">Order validated</span>
					<p class="message">Thank you for your purchase.
						<?php echo $status; ?>
					</p>
				</div>
				<div class="actions">
					<a href="logout.php"><button type="button" class="history">Continue</button></a>
				</div>
			</div>
		</div>
	</div>



</body>

</html>