<check if="{{@login}} === True && strpos({{@admin->getAdminLevel()}}, Alert) !== false">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <check if="{{sizeOf(@errors) > 0}}">
                    <div class="alert alert-danger">
                        <strong>Error!</strong>
                        <p>
                            {{@errors}}
                        </p>
                    </div>
                </check>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <check if="{{@alert}} == null">
                    <true>
                        <div class="col-sm-offset-1 col-sm-6">
                            <div class="page-header">
                                <h1>
                                    Add A New Alert
                                </h1>
                            </div>
                        </div>
                        <div class="col-sm-offset-3 col-sm-6">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="alertName">Alert Name</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="alertName" required>
                                    </div>
                                </div>

                                <div id="bio" class="form-group">
                                    <label class="control-label col-sm-12" for="alertMessage">Alert Message</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" type="text" rows="4" name="alertMessage" required></textarea>
                                        <div class="spacer"></div>
                                    </div>
                                </div>

                                <div class="col-xs-offset-5 col-sm-6">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                    <div class="spacer"></div>
                                </div>
                            </form>
                        </div>
                    </true>
                    <false>
                        <div class="col-sm-offset-1">
                            <div class="page-header">
                                <h1>
                                    Update {{@alert->getAlertName()}}
                                </h1>
                            </div>
                        </div>
                        <div class="col-sm-offset-3 col-sm-6">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="alertName">Alert Name</label>
                                    <div class="col-sm-12">
                                        <check if="{{@alert->getAlertName()}} ==''">
                                            <true>
                                                <input class="form-control" type="text" name="alertName" required>
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" name="alertName" value="{{@alert->getAlertName()}}" required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="alertMessage">Alert Message</label>
                                    <div class="col-sm-12">
                                        <check if="{{@alert->getAlertMessage()}} == ''">
                                            <true>
                                                <textarea class="form-control" type="text" rows="4" name="alertMessage" required></textarea>
                                                <div class="spacer"></div>
                                            </true>
                                            <false>
                                                <textarea class="form-control" type="text" rows="4" name="alertMessage" required>{{@alert->getAlertMessage()}}</textarea>
                                                <div class="spacer"></div>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="col-xs-offset-5 col-sm-6">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                    <div class="spacer"></div>
                                </div>
                            </form>
                        </div>
                    </false>
                </check>
            </div>
        </div>
    </div>
</check>