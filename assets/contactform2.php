<?php
if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "nelson20@gmail.com";
    $email_subject = "Interested in Coffee Airstream";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['email']) ||
        !isset($_POST['city']) ||
        !isset($_POST['financing'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $name = $_POST['name']; // required
    $phone = $_POST['phone']; // required
    $email_from = $_POST['email']; // required
    $city = $_POST['city']; // required
    $financing = $_POST['financing']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z\s.'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The name you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[0-9s.'-]+$/";
  if(!preg_match($string_exp,$phone)) {
    $error_message .= 'The phone number you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z,\s.'-]+$/";
  if(!preg_match($string_exp,$city)) {
    $error_message .= 'The city and state you entered do not appear to be valid.<br />';
  }
      $string_exp = "/^[A-Za-z,\s.'-]+$/";
  if(!preg_match($string_exp,$financing)) {
    $error_message .= 'The answer for financing does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Phone Number: ".clean_string($phone)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "City, State: ".clean_string($city)."\n";
    $email_message .= "Financing: ".clean_string($financing)."\n";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
sleep(2);
echo "<meta http-equiv='refresh' content=\"0; url=http://airstreamcoffeeshop.info/thankyou.html\">";
?>

<?php
}
?>