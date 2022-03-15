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

        <form id="contact-form">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <input type="text" id="name" name="name" class="form-control" required />
                        <label for="name" class="">Your name</label>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <input type="email" id="email" name="email" class="form-control" required />
                        <label for="email" class="">Your email</label>
                    </div>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <input type="text" id="subject" name="subject" class="form-control" required/ >
                        <label for="subject" class="">Subject</label>
                    </div>
                </div>
            </div>
            <!--Grid row-->
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-12">

                    <div class="md-form">
                        <textarea type="text" id="message" name="message" rows="4" class="form-control md-textarea" required></textarea>
                        <label for="message">Your message</label>
                    </div>
                </div>
            </div>
            <!--Grid row-->
            <button type="submit" class="btn btn-block btn-primary mt-3">Send</button>
        </form>
    </div>
</div>

<script>
    $('#contact-form').submit(function(e){
        e.preventDefault()
    
        start_load()
        $.ajax({
            url:"admin/ajax.php?action=contact_us",
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp==1){
                    alert_toast("Message sent.")
                    setTimeout(function(){
                        location.reload();
                    },1500)
                }
            }
        })
    })
</script>