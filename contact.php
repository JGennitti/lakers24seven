<?php

$to = "info@lakers24seven.com";
$subject = 'Comments from Lakers24Seven user.';

$name = $_POST['name'];
$email = $_POST['email'];
$topic = $_POST['topic'];
$message = $_POST['message'];

$body = <<<EMAIL

From: $name. 

Topic: $topic 

Message: $message 

My email address is: $email

EMAIL;

$header = "From: $email";

if($_POST['address'] != '') {
	echo "Your form submission has an error.";
	exit;
}


function test_input($data) // function for test_input() trims ect.
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

// main control flow 
if($_POST){
	if($_POST['email'] != ''){ // if email is not blank
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)){  // if email does not validate
			   $emailError = '*Invalid email format.'; //report invalid email
			}
			else{
			//  if email validates continue this 
			$name1 = test_input($_POST['name']);
						if(!preg_match("/^[a-zA-Z ]*$/",$name1)){  // if name or message is left blank
							$nameError = '*Only letters and white space allowed'; // error message for blanks
						}else{
							if($_POST['message'] =='') {
								$messageError = '*Please, Fill Name and/or Message'; // error message for blanks
								}
								elseif($_POST['name'] == '') {
									$nameBlankError = '*Please, enter your name'; // error for blank name
								}
								else {
									mail($to, $subject, $body, $header);
										$feedback = 'Thanks, Your message has been sent';
							}
						}
			}  
	}
	else{
		if($email == '' || $name == '' || $message == '' ){
			 $feedbackError = '*Please, Fill out all the fields!';  
		}
	}
}
//main control flow

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lakers24Seven | Lakers Fan Page | Lakers Forums | Contact</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link href='http://fonts.googleapis.com/css?family=Changa+One|Open+Sans:400italic,700italic,400,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/responsive_tablet.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!-- Header bar -->
<header>
		<div id="logo_wrap">
			<a href="index.html">
				<img src="img/lakers2.png" alt="lakers24seven_logo" id="logo" />
			</a>
		</div>	
<!-- Navigation bar -->
		<nav>
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="http://www.nba.com/lakers/roster" target="_blank">Roster</a></li>
                <li><a href="http://i.cdn.turner.com/drp/nba/lakers/sites/default/files/lakers1415.pdf" target="_blank">Schedule</a></li>
                <li><a href="salary.html">Team Salary</a></li>
				<li><a href="forum/index.php">Forum</a></li>
			</ul>
		</nav>
</header>
<!-- Main content section -->
<div id="wrapper">
	<h1 id="contact_header">Contact Form</h1>
	<div id="feedback_wrap">
		<p id="feedback"><?php echo $feedback; ?></p>
		<p id="feedbackError"><?php echo $feedbackError; ?></p>
	</div>
	<section id="contact_form">
		<form action="?" method="POST">
			<ul>
				<li>
					<label for="name">Name:</label>
					<input type="text" name="name" id="name" /><span id="nameError"><?php echo $nameError ?></span><span id="nameBlankError"><?php echo $nameBlankError ?></span>
				</li>
				<li>
					<label for="email">Email: </label>
					<input type="text" name="email" id="email" /><span id="emailError"><?php echo $emailError ?></span>
				</li>
				<li style="display: none;">
					<label for="address">Adress</label>
					<input type="text" name="address" id="address">
					<p>User please leave this field blank.</p>
				</li>
				<li>
					<label for="topic">Topic:</label>
					<select id="topic" name="topic">
						<option Value="Suggestions">Suggestions</option>
						<option Value="Complaints">Complaints</option>
						<option Value="Advertising">Advertising</option>
					</select>
				</li>
				<li>
					<label for="message">Please leave a message and we will get back to you as soon as possible:</label>
					<textarea id="message" name="message" cols="42" rows="9" maxlength="500"></textarea><span id="messageError"><?php echo $messageError; ?></span>
				</li>
				<li>
					<input type="submit" value="Submit" id="submit">
				</li>
			</ul>
		</form>
	</section>
</div>
<!-- Mobile navigation section -->
<div id="mobile_wrap">
	<section>
		<ul id="mobile_nav">
			<li><a href="http://www.nba.com/lakers/roster" target="_blank">Roster</a></li>
		    <li><a href="http://www.basketball-reference.com/contracts/LAL.html" target="_blank">Team Salary</a></li>
		    <li><a href="http://i.cdn.turner.com/drp/nba/lakers/sites/default/files/lakers1415.pdf" target="_blank">Schedule</a></li>
			<li><a href="forum/index.php">Forum</a></li>
			<li><a href="contact.php">Contact Us</a></li>
		</ul>
	</section>

	<div id="mobile_bg">
	<img src="img/staples_night.jpg" id="staples" />
	</div>
</div>
<!-- footer section -->
	<footer>
	<p id="tweet"><a href="http://twitter.com/Lakers_24Seven" target="_blank"><img src="img/icon/twitter-wrap.png" alt="Twitter Logo" class="social-icon"></a></p>
	<p id="footer_title">&copy; 2014 WWW.LAKERS24SEVEN.COM</p>
	<p id="footer_disclaimer">Lakers24Seven is an unofficial news source and forum fan community since 2014.<br>
	We are in no way associated with the <a style="color: #fdb826;" href="http://www.lakers.com" target="_blank">Los Angeles Lakers</a> or the <a style="color: #fdb826;" href="http://www.nba.com" target="_blank">National Basketball Association.</a></p>
	</footer> 
</body>
</html>
