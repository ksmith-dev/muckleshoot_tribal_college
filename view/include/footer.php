    <footer>
        <div class="container-fluid">
            <div id="address" class="col-xs-12 col-sm-4">
                <div class="spacer"></div>
                <img src="{{@BASE}}/asset/img/logo-text.png" class="img-responsive">
                <div class="spacer"></div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2708.321197057341!2d-122.1198688834223!3d47.249422179162586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5490f6d21787113d%3A0x3ab46b97db6e2576!2s39811+Auburn+Enumclaw+Rd+SE%2C+Auburn%2C+WA+98092!5e0!3m2!1sen!2sus!4v1492655990275" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                <div class="spacer"></div>
                <address>39811 Auburn-Enumclaw Road S.E.<br>Auburn, WA 98092</address>
                Phone: <a href="tel:2538763183">(253) 876-3183</a>
            </div>
            <div class="hidden-xs col-sm-4">
            </div>
            <div class="hidden-xs col-sm-4">
                <div class="spacer"></div>
                <form name="myForm" action="{{@BASE}}/footerEmail" onsubmit="return validateForm()" method="post" >
                    <h3>Need Help</h3>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-xs-9">
                                <p>Enter your email and question and we will get back to you as soon as possible.</p>
                            </div>
                            <div class="col-xs-2 round">
                                <span class="big-question-mark">?</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name = "email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="question">Question:</label>
                        <textarea type="text" class="form-control" name= "question" id="question"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </footer>
    <div class="spacer-lg"></div>
    </body>
    <script>
        function validateForm() {

            var emails = document.forms["myForm"]["email"].value;

            var questions = document.forms["myForm"]["question"].value;
            var atpos = emails.indexOf("@");
            var dotpos = emails.lastIndexOf(".");
            var errorLog = "ERROR: \n";

            if (emails == "") {
                errorLog += "Email must be filled out \n";

            } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emails.length) {
                errorLog += "Not a valid e-mail address \n";

            } else {

            }
            if (questions == "" || questions.length == 0||questions == "bool(false)") {
                errorLog += "Question must be filled out \n";
            }

            if (errorLog != "ERROR: \n") {
                alert(errorLog);
                return false;
            } else {
                
                return true;
            }


        }
    </script>
</html>