<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Baoyue Wang's Personal Website</title>
</head>
<body>
    <!-- header part of the website -->
    <header>
        <div id="title">Baoyue Wang</div>
        <div id="nav">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="education.html">Education</a></li>
                <li><a href="project.html">Project</a></li>
                <li><a href="contact.html">Contact Me</a></li>
            </ul>
        </div>
    </header>

    <!-- main content of the page -->
    <div id="main">
        <div class="section" style="height: 650px">
            <h1>Please fill in the form below to send me a message.</h1>

                <!-- contact form part -->
                <form method="post">
                    <ul>
                        <li>Name:</li>
                        <input type="text" name="name"/>
                        <li>Email:</li>
                        <input type="text" name="email" placeholder="abc@abc.com"/>
                        <li>Phone:</li>
                        <input type="text" name="phone" placeholder="xxx-xxx-xxxx"/>
                        <li>Organization:</li>
                        <input type="text" name="org"/>
                        <li>How would you like me to contact you?</li>
                        <input class="radio" type="radio" name="way" value="Email"/><div class="opt">Email</div>
                        <input class="radio" type="radio" name="way" value="Phone"/><div class="opt">Phone</div>
                        <input class="radio" type="radio" name="way" value="Either"/><div class="opt">Either is okay</div>
                        <div class="clear"></div>
                        <li>Message:</li>
                        <textarea name="message" cols="80" rows="10" placeholder="Please enter your message"/></textarea>
                        <input id="submitbtn" style="width: 120px;height: 30px;" type="submit" name="submit" value="submit"/>
                    </ul>
                </form>
                <!-- php section -->
                <?php
                    if(isset($_POST["submit"])) {
                        // set php variables
                        $name = isset($_POST['name']) ? $_POST['name'] : '';
                        $email = isset($_POST['email']) ? $_POST['email'] : ''; 
                        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                        $org = isset($_POST['org']) ? $_POST['org'] : '';  
                        $way = isset($_POST['way']) ? $_POST['way'] : '';
                        $msg = isset($_POST['message']) ? $_POST['message'] : '';    
                        $error="";

                        // check if there are errors. Use conditional clause
                        if (empty($name)||empty($email)||!filter_var($email, FILTER_VALIDATE_EMAIL)||empty($phone)||!preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone)||empty($org)||empty($way)||empty($msg)) {
                            if (empty($name)) {
                                $error = "Please enter your name.</br>";
                            }
                            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $error .= "Please enter a valid email address.</br>";
                            }
                            if (empty($phone) || !preg_match("/^[2-9]\d{2}-\d{3}-\d{4}$/", $phone)) {
                                $error .= "Please enter a valid phone number.</br>";
                            }
                            if (empty($org)) {
                                $error .= "Please enter your organization.</br>";
                            }
                            if (empty($way)) {
                                $error .= "Please choose a way to contact.</br>";
                            }
                            if (empty($msg)) {
                                $error .= "Please enter your message.</br>";
                            }
                            if (!empty($error)) {
                                $alert = '<div id="alert">Please fix the error(s) in your form: </br>'.$error.'</div>';
                                echo $alert;
                            }
                        } 

                        // inputs are all valid. Send me an email with contents of users' inputs and give users a confirmation message.
                        else {
                            // Arrays
                            $input=array("Name"=>$name, "Email"=>$email, "Phone"=>$phone, "Organization"=>$org,"Contact Method"=>$way, "Message"=>$msg);

                            // Function and loop
                            function displayInput($input) {
                                $result = "";
                                foreach ($input as $title=>$content) {
                                    $result .= $title.": ".$content." ";
                                }
                                return $result;
                            }
                            // if mail function works successfully, send users a confirmation message.
                            if (mail("bw476@cornell.edu", "Message from my personal website", displayInput($input))) {

                                $alert ='<div id="alert" style="border-color: #18bc9c">Thank you! Here is a summary of your message:</br>';
                                foreach ($input as $title=>$content) {
                                    $alert .= $title.': '.$content.'</br>';
                                }
                                $alert.='</div>';
                                echo $alert;
                            }

                        }
                    }
                ?>

        </div>
    </div>

    <!-- footer of the website -->
    <footer>
        <p>Copyright&#169;Baoyue Wang</p>
    </footer>

</body>
</html>