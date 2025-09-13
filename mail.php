<?php
// Only process POST requests.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = strip_tags(trim($_POST["fname"]));
    $phone = trim($_POST["tel"]);
    $level = trim($_POST["level"]);
    $grade = trim($_POST["grade"]);
    $school = strip_tags(trim($_POST["school"]));
    $branch = strip_tags(trim($_POST["branch"]));
    $gender = strip_tags(trim($_POST["gender"]));

    // Check that data was sent to the mailer.
    if (empty($name) || empty($phone) || empty($level) || empty($grade) || empty($school) || empty($branch) || empty($gender)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address.
    // FIXME: Update this to your desired email address.
    $recipient = "info@yourdomain.com";

    // Set the email subject.
    $subject = "New Registration for Robotica";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Level: $level\n";
    $email_content .= "Grade: $grade\n";
    $email_content .= "School: $school\n";
    $email_content .= "Branch: $branch\n";
    $email_content .= "Gender: $gender\n";

    // Build the email headers.
    $email_headers = "From: $name <$phone>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your registration has been sent.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your registration.";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
