<div class="container-fluid" >
    <div class="row">
        <div class="col-sm-12">
            <check if="{{sizeOf(@errors)}} > 0">
                <true>
                <div class="alert alert-danger">
                    <strong>Error!</strong>
                    <p>
                        <repeat group="{{@errors}}" value="{{@error}}">
                            {{ @error }}
                            <br />
                        </repeat>
                    </p>
                </div>
                    </true>
                <false></false>

            </check>
        </div>
    </div>
    <div class="spacer-lg" ></div>


    <div class="row align-items-center">
        <div class=" col-sm-8 col-sm-offset-2"  >
            <h1> HAVE A QUESTION, COMMENT, OR REQUEST?</h1>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="row">
                <div class=" col-sm-offset-2 col-sm-4">
                    <p> Email us and the appropriate staff person will return your email as soon as possible.  If your question or request requires a swift response, please call us directly. </p>
                </div>
                <div class=" col-sm-4">
                    <address>
                        <strong>Address:</strong><br>
                        39811 Auburn-Enumclaw Road SE<br>
                        Auburn, Washington 98092<br>
                        <strong>Phone:</strong><br>
                        253.876.3183<br>
                        <strong>Fax:</strong><br>
                        253.876.2883<br>
                    </address>
                </div>

    </div>

    <div class="row ">
        <div class=" col-sm-8 col-sm-offset-2">
            <h2>Please use the form below to send us an email:</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-offset-2 col-sm-8" id ="contactusform" >
            <form name="myForm2" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>"  onsubmit="return validateForms()"  method="post" enctype="multipart/form-data">


                <div class="form-group">
                    <label class="control-label col-sm-12" for="name">Name (Required):</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="name"  required>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="spacer"></div>
                </div>

                <div class="form-group">
                    <div class="col-sm-8">
                        <label class="control-label col-sm-12" for="phone">Phone# (Optional):</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="phone" >
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <label class="control-label col-sm-12" for="ext">ext:</label>


                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="ext" >
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="spacer"></div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-12 " for="email">Email (Required):</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="spacer"></div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-12 " for="questions">Comments (Required):</label>
                    <div class="col-sm-12">
                        <textarea rows="5"  class="form-control" name="questions"  required></textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="spacer"></div>
                </div>


                <div class="form-group">
                    <div class=" col-sm-12">
                        <button type="submit"class="btn btn-default">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="spacer-lg" ></div>
    <script>
        function validateForms() {

            var emails = document.forms["myForm2"]["email"].value;
            var name = document.forms["myForm2"]["name"].value;
            var questions = document.forms["myForm2"]["questions"].value;
            var phone  = document.forms["myForm2"]["phone"].value;
            var phone_regex = /^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/;

            var atpos = emails.indexOf("@");
            var dotpos = emails.lastIndexOf(".");
            var errorLog = "ERROR: \n";
            if (name == "" || name.length == 0||name == "bool(false)") {
                errorLog += "Please enter a name \n";
            }
            if (emails == "" ||emails == "bool(false)") {
                errorLog += "Email must be filled out \n";

            } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emails.length) {
                errorLog += "Please enter a valid e-mail address \n";

            }

            if (phone != "" && phone.length != 0 && phone != "bool(false)") {
                //result2 = phone_regex.test(phone);
                if (!phone_regex.test(phone)){
                    errorLog += "Please enter a valid phone number \n";
                }

            }
            if (questions == "" || questions.length == 0||questions == "bool(false)") {

                errorLog += "Please enter a comment or question\n";
            }

            if (errorLog != "ERROR: \n") {
                alert(errorLog);
                return false;
            } else {

                return true;
            }


        }
    </script>
</div>

