<?php
if (isset($_POST['Email'])) {

    // CHANGE THE TWO LINES BELOW
    $email_to = "info@thebusinessanalysts.be";

    $email_subject = "website tba contactformulier";


    function died($error)
    {
        // your error code can go here
        echo "Er is een fout opgetreden bij het versturen van de email, gelieve opnieuw te proberen. ";
        echo "Onderstaande error(s) zijn voorgekomen.<br /><br />";
        echo $error . "<br /><br />";
        die();
    }

    // validation expected data exists
    if (!isset($_POST['Naam']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Boodschap'])
    ) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $first_name = $_POST['Naam']; // required
    $email_from = $_POST['Email']; // required
    $comments = $_POST['Boodschap']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,4}$/';
    if (!preg_match($email_exp, $email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }
    $string_exp = "/^[A-Za-z .'-]+$/";
    if (!preg_match($string_exp, $first_name)) {
        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }
    if (strlen($comments) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }
    if (strlen($error_message) > 0) {
        died($error_message);
    }
    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Naam: " . clean_string($first_name) . "\n";
    $email_message .= "Email: " . clean_string($email_from) . "\n";
    $email_message .= "Boodschap: " . clean_string($comments) . "\n";


// create email headers
    $headers = 'From: ' . $email_from . "\r\n" .
        'Reply-To: ' . $email_from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
//echo "U bericht is succesvol verzonden!";

    ?>

    <!-- place your own success html below -->
    <?php
    header("Location: http://www.thebusinessanalysts.be/index.html");
    ?>

    <?php
}
die();
?>
