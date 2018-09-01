<check if="{{@login}} === True && strpos({{@admin->getAdminLevel()}}, Users) !== false">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <check if="{{sizeOf(@errors)}} > 0">
                    <true>
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            <p>
                                <repeat group="{{@errors}}" value="{{@error}}">
                                    {{@error}}
                                    <br>
                                </repeat>
                            </p>
                        </div>
                    </true>
                    <false>

                    </false>
                </check>
            </div>
        </div>
        <div class="spacer"></div>
        <div class="row">




                <check if="{{@Admin}} == null">

                    <true>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="col-sm-offset-1 col-sm-10">
                            <div class="page-header">
                                <h1>Create a new user</h1>
                            </div>
                        </div>
                        <div class="col-sm-offset-3 col-sm-6">

                            <div class="spacer"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="userName">User Name</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="userName" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="password">Password</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="confirmPassword">Confirm Password</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="password" name="confirmPassword" required>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="accessLevel">Admin Access</label>
                                <div class="col-sm-12">
                                    <input type="checkbox" name="accessLevel[]" value="Alerts"> Alerts<br>
                                    <input type="checkbox" name="accessLevel[]" value="Events"> Events<br>
                                    <input type="checkbox" name="accessLevel[]" value="FinancialAid"> Financial Aid<br>
                                    <input type="checkbox" name="accessLevel[]" value="Partners"> Partners<br>
                                    <input type="checkbox" name="accessLevel[]" value="Programs"> Programs<br>
                                    <input type="checkbox" name="accessLevel[]" value="Resources"> Resources<br>
                                    <input type="checkbox" name="accessLevel[]" value="Staff"> Staff<br>
                                    <input type="checkbox" name="accessLevel[]" value="StudentWork"> Student Work<br>
                                    <input type="checkbox" name="accessLevel[]" value="Users"> Users<br>
                                </div>


                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="col-xs-offset-5 col-sm-6">
                                <input class="btn btn-primary" type="submit" value="Submit">
                                <div class="spacer"></div>
                            </div>
                        </div>
                        </form>
                    </true>



                    <false>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="col-sm-offset-1 col-sm-10">
                            <div class="page-header">
                                <h1>Edit user</h1>
                            </div>
                        </div>


                        <div class="col-sm-offset-3 col-sm-6">

                            <div class="spacer"></div>


                            <div class="form-group">
                                <label class="control-label col-sm-12" for="userName">User Name</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="userName" value="{{@Admin->getAdminUsername()}}">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="password"> New Password</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="password" name="password" >
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="confirmPassword"> Confirm new Password</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="password" name="confirmPassword">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="accessLevel">Admin Access</label>
                                <div class="col-sm-12">
                                    <!--<p>Current access: {{@Admin->getAdminLevel()}}</p>-->
                                    <!-- strstr(string,search,before_search)-->
                                    <check if="strstr({{@Admin->getAdminLevel()}}, Alerts)=== false">
                                        <true>
                                            <input type="checkbox" name="accessLevel[]" value="Alerts"> Alerts<br>
                                        </true>
                                        <false>
                                            <input type="checkbox" name="accessLevel[]" value="Alerts" checked> Alerts<br>
                                        </false>
                                    </check>

                                    <check if="strstr({{@Admin->getAdminLevel()}}, Events)=== false">
                                        <true>
                                            <input type="checkbox" name="accessLevel[]" value="Events"> Events<br>
                                        </true>
                                        <false>
                                            <input type="checkbox" name="accessLevel[]" value="Events" checked> Events<br>
                                        </false>
                                    </check>

                                    <check if="strstr({{@Admin->getAdminLevel()}}, FinancialAid)=== false">
                                        <true>
                                            <input type="checkbox" name="accessLevel[]" value="FinancialAid"> FinancialAid<br>
                                        </true>
                                        <false>
                                            <input type="checkbox" name="accessLevel[]" value="FinancialAid" checked> FinancialAid<br>
                                        </false>
                                    </check>

                                    <check if="strstr({{@Admin->getAdminLevel()}}, Partners)=== false">
                                        <true>
                                            <input type="checkbox" name="accessLevel[]" value="Partners"> Partners<br>
                                        </true>
                                        <false>
                                            <input type="checkbox" name="accessLevel[]" value="Partners" checked> Partners<br>
                                        </false>
                                    </check>

                                    <check if="strstr({{@Admin->getAdminLevel()}}, Programs)=== false">
                                        <true>
                                            <input type="checkbox" name="accessLevel[]" value="Programs"> Programs<br>
                                        </true>
                                        <false>
                                            <input type="checkbox" name="accessLevel[]" value="Programs" checked> Programs<br>
                                        </false>
                                    </check>

                                    <check if="strstr({{@Admin->getAdminLevel()}}, Resources)=== false">
                                        <true>
                                            <input type="checkbox" name="accessLevel[]" value="Resources"> Resources<br>
                                        </true>
                                        <false>
                                            <input type="checkbox" name="accessLevel[]" value="Resources" checked> Resources<br>
                                        </false>
                                    </check>

                                    <check if="strstr({{@Admin->getAdminLevel()}}, Staff)=== false">
                                        <true>
                                            <input type="checkbox" name="accessLevel[]" value="Staff"> Staff<br>
                                        </true>
                                        <false>
                                            <input type="checkbox" name="accessLevel[]" value="Staff" checked> Staff<br>
                                        </false>
                                    </check>

                                    <check if="strstr({{@Admin->getAdminLevel()}}, StudentWork)=== false">
                                        <true>
                                            <input type="checkbox" name="accessLevel[]" value="StudentWork"> Student Work<br>
                                        </true>
                                        <false>
                                            <input type="checkbox" name="accessLevel[]" value="StudentWork" checked> Student Work<br>
                                        </false>
                                    </check>

                                    <check if="strstr({{@Admin->getAdminLevel()}}, Users)=== false">
                                        <true>
                                            <input type="checkbox" name="accessLevel[]" value="Users"> Users<br>
                                        </true>
                                        <false>
                                            <input type="checkbox" name="accessLevel[]" value="Users" checked> Users<br>
                                        </false>
                                    </check>
                                </div>

                            </div>

                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            

                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="col-xs-offset-5 col-sm-6">
                                <input class="btn btn-primary" type="submit" value="Submit">
                                <div class="spacer"></div>
                            </div>
                            </form>


                    </false>
                </check>


        </div>
</div>

    <div class="spacer-lg"></div>

</check>