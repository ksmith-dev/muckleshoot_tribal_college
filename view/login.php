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
                </div></p>
            </check>
        </div>
        <div class="col-sm-12">
            <div id="loginBox" class="col-sm-offset-1 col-sm-10">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="form-horizontal">
                    <div class="login col-sm-offset-3 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="username">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username">
                            </div>
                            <br>
                            <br>
                            <label class="control-label col-sm-3" for="password">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="col-sm-offset-5 col-sm-10">
                            <button id="loginCustom" type="submit" class="btn btn-primary">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>