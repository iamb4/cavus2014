<?php
if(isset($_POST['email'])) {
require_once "Mail.php"; //PEAR mail is already installed in our current environment

$email_to = "waitinglist@cavusvineyards.com";  //Enter the email you want to send the form to
$email_subject = "Waiting List Form Submission";  // You can put whatever subject here 
$host = "mail.cavusvineyards.com";  // The name of your mail server. (Commonly mail.yourdomain.com if your mail is hosted with HostMySite)
$username = "waitinglist@cavusvineyards.com";  // A valid email address you have setup 
$from_address = "waitinglist@cavusvineyards.com";  // If your mail is hosted with HostMySite this has to match the email address above 
$password = "wa1t1ngList";  // Password for the above email address
$reply_to = "info@cavusvineyards.com";  //Enter the email you want customers to reply to
$port = "25"; // This is the default port. Try port 50 if this port gives you issues and your mail is hosted with HostMySite
$thank_you_url = "thankyou.html"; // The url the viewer goes to after the form is successfully sent

function died($error) {
	// your error code can go here 
	echo "We are very sorry, but there were error(s) found with the form you submitted.<br />"; 
	echo "These errors appear below.<br /><br />"; 
	echo $error."<br /><br />"; 
	echo "Please go back and fix these errors.<br /><br />";
	die();
}

// Validate expected data exists
if(!isset($_POST['full_name']) || !isset($_POST['addrs1']) || !isset($_POST['addrs2']) || !isset($_POST['email'])) {
	died('We are sorry, but there appears to be a problem with the form you submitted.');
}

$full_name = $_POST['full_name']; // required 
$email_from = $_POST['email']; // required 
$subject = $_POST['subject']; // not required
$addrs1 = $_POST['addrs1']; // not required 
$addrs2 = $_POST['addrs2']; // not required 
$telephone = $_POST['telephone']; // not required 
$comments = $_POST['comments']; // required 

$error_message = ""; 
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/'; 
if(!preg_match($email_exp,$email_from)) {
	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
} 
$string_exp = "/^[A-Za-z .'-]+$/"; 
if(!preg_match($string_exp,$full_name)) {
	$error_message .= 'The name you entered does not appear to be valid.<br />';
}
if(strlen($addrs1) < 8) {
	$error_message .= 'The Address you entered does not appear to be valid.<br />';
}
if(strlen($addrs2) < 8) {
	$error_message .= 'The City, State, Zip you entered does not appear to be valid.<br />';
}

if(strlen($error_message) > 0) {
	died($error_message);
}
$email_message = "Form details below.\n\n";
function clean_string($string) {
	$bad = array("content-type","bcc:","to:","cc:","href");
	return str_replace($bad,"",$string);
}

$email_message .= "<strong>Name:</strong> ".clean_string($full_name)."\n";
$email_message .= "<strong>Email:</strong> ".clean_string($email_from)."\n";
$email_message .= "<strong>Phone:</strong> ".clean_string($telephone)."\n\n";
$email_message .= "<strong>Address:</strong>\n".clean_string($addrs1)."\n".clean_string($addrs2)."\n\n";
$email_message .= "<strong>Subject:</strong> ".clean_string($subject)."\n";
$email_message .= "<strong>Comments:</strong> ".clean_string($comments)."\n\n";

// This section creates the email headers
$auth = array('host' => $host, 'auth' => true, 'username' => $username, 'password' => $password);
$headers = array('From' => $from_address, 'To' => $email_to, 'Subject' => $email_subject, 'Reply-To' => $reply_to);

// This section send the email
$smtp = Mail::factory('smtp', $auth);
$mail = $smtp->send($email_to, $headers, $email_message);

if (PEAR::isError($mail)) {?>
<!-- include your own failure message html here -->
  Unfortunately, the message could not be sent at this time. Please try again later.

<!-- Uncomment the line below to see errors with sending the message -->
<!-- <?php echo("<p>". $mail->getMessage()."</p>"); ?> -->

<?php } else { 

header("Location: " . $thank_you_url); ?>

<?php } } ?>