
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <check if="{{sizeOf(@errors) > 0}}">
                <div class="alert alert-danger">
                    <strong>Error!</strong>
                    <p>
                        <repeat group="{{@errors}}" value="{{ @error }}">
                            {{ @error }}
                            <br />
                        </repeat>
                    </p>
                </div>
            </check>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="spacer"></div>
            <form name="myForm" action="{{@BASE}}/footerEmail" onsubmit="return validateForm()" method="post" >
                
                <h1>Need Help</h1>
                <p>Enter your email and question and we will get back to you as soon as possible.</p>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name = "email" id="email">
                </div>
                <div class="form-group">
                    <label for="question">Question:</label>
                    <textarea type="text" class="form-control" name= "question" id="question"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
    <div class="spacer-lg"></div>
</div>


</body>
<script>
    function validateForm() {

        var emails = document.forms["myForm"]["email"].value;

        var questions = document.forms["myForm"]["questions"].value;
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
