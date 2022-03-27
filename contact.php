<?php
    if(isset($_POST["send-submit"])){
        $email = $_POST["email"];
        $name = $_POST["name"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        $whom = "cynthiadianneaque@gmail.com";

        $comment = "Name: ".$name."\n";
        $comment .= "Email: ".$email."\n";
        $comment .= "Message: ".$message."\n";
        
        mail($whom, $subject, $comment);
        echo '<script>alert("Message sent.")</script>';
    }
?>

<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    <h1 class="text-uppercase text-white font-weight-bold">Contact Us</h1>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<div class="container mt-5">
    <div class="w-100 m-auto" style="max-width: 600px">
        <h2 class="h1-responsive font-weight-bold text-center my-6">Contact us</h2>
        <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
    a matter of hours to help you.</p>

        <form id="contact-form" action="" method="POST">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                    <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required />
                    </div>
                </div>
            </div>
            <!--Grid row-->
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-12">

                    <div class="md-form">
                        <label for="message">Your message</label>
                        <textarea type="text" id="message" name="message" rows="4" class="form-control md-textarea" required></textarea>
                    </div>
                </div>
            </div>
            <!--Grid row-->
            <button type="submit" class="btn btn-block btn-primary mt-3" name="send-submit">Send</button>
        </form>
    </div>
</div>

<!-- <script>
    $('#contact-form').submit(function(e){
        e.preventDefault()
        console.log('here', $(this).serialize())
    
        start_load()
        $.ajax({
            url:"admin/ajax.php?action=contact_us",
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp==1){
                    alert_toast("Message sent.")
                    
                }
            }
        })
    })
</script> -->