<check if="{{@login}} === True && strpos({{@admin->getAdminLevel()}}, Staff) !== false">
    <true>
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
            <script>
                $(function() {
                    $( "#datepicker-10" ).datepicker({
                        changeMonth:true,
                        changeYear:true,
                        dateFormat:"yy-mm-dd"
                    });
                });
            </script>
            <div class="row">
                <div class="col-sm-12">
                    <check if="{{@Staff}} == null">
                        <true>
                            <div class="col-sm-offset-1 col-sm-6">
                                <div class="page-header">
                                    <h1>Add A New Staff Member</h1>
                                </div>
                            </div>
                            <div class="col-sm-offset-3 col-sm-6">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffName">Name</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="staffName" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffTitle">Title</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="staffTitle">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffJobTitle">Job Title</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="staffJobTitle" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffOrganization">Organization</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="staffOrganization" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffCredentials">Credentials</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="staffCredentials" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffDepartment">Department</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="staffDepartment" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffHiredDate">Hired Date</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="staffHiredDate" id="datepicker-10">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffLocation">Location</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="staffLocation" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffContact">Email/Phone number</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="text" name="staffContact" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffImage">Image</label>
                                        <div class="col-sm-12">
                                            <input id="imageUpload" class="form-control" type="file" name="fileToUpload" id="fileToUpload" >
                                        </div>
                                    </div>

                                    <div id="bio" class="form-group">
                                        <label class="control-label col-sm-12" for="bio">Description</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" type="text" rows="4" name="staffDescription" required></textarea>
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
                            <div class="col-sm-offset-1 col-sm-6">
                                <div class="page-header">
                                    <h1>Update {{@Staff->getFirstName() }} {{ @Staff->getLastName()}}</h1>
                                </div>
                            </div>
                            <div class="col-sm-offset-3 col-sm-6">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffName">Name</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getFirstName()}} == '' && {{@Staff->getLastName()}} == ''">
                                                <true>
                                                    <input class="form-control" type="text" name="staffName" required>
                                                </true>
                                                <false>
                                                    <input class="form-control" type="text" name="staffName" value="{{@Staff->getFirstName()}} {{@Staff->getLastName()}}" required>
                                                </false>
                                            </check>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffTitle">Title</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getTitle()}} == ''">
                                                <true>
                                                    <input class="form-control" type="text" name="staffTitle">
                                                </true>
                                                <false>
                                                    <input class="form-control" type="text" name="staffTitle" value="{{@Staff->getTitle()}}">
                                                </false>
                                            </check>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffJobTitle">Job Title</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getJobTitle()}} == ''">
                                                <true>
                                                    <input class="form-control" type="text" name="staffJobTitle" required>
                                                </true>
                                                <false>
                                                    <input class="form-control" type="text" name="staffJobTitle" value="{{@Staff->getJobTitle()}}" required>
                                                </false>
                                            </check>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffOrganization">Organization</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getOrganization()}} == ''">
                                                <true>
                                                    <input class="form-control" type="text" name="staffOrganization" required>
                                                </true>
                                                <false>
                                                    <input class="form-control" type="text" name="staffOrganization" value="{{@Staff->getOrganization()}}" required>
                                                </false>
                                            </check>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffCredentials">Credentials</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getCredentials()}} == ''">
                                                <true>
                                                    <input class="form-control" type="text" name="staffCredentials" required>
                                                </true>
                                                <false>
                                                    <input class="form-control" type="text" name="staffCredentials" value="{{@Staff->getCredentials()}}" required>
                                                </false>
                                            </check>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffDepartment">Department</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getDepartment()}} == ''">
                                                <true>
                                                    <input class="form-control" type="text" name="staffDepartment" required>
                                                </true>
                                                <false>
                                                    <input class="form-control" type="text" name="staffDepartment" value="{{@Staff->getDepartment()}}" required>
                                                </false>
                                            </check>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffHiredDate">Hired Date</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getDateHired()}} == ''">
                                                <true>
                                                    <input class="form-control" type="text" name="staffHiredDate" >
                                                </true>
                                                <false>
                                                    <input class="form-control" type="text" name="staffHiredDate" id="datepicker-10" value="{{@Staff->getDateHired()}}" >
                                                </false>
                                            </check>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffLocation">Location</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getLocation()}} == ''">
                                                <true>
                                                    <input class="form-control" type="text" name="staffLocation" >
                                                </true>
                                                <false>
                                                    <input class="form-control" type="text" name="staffLocation" value="{{@Staff->getLocation()}}" >
                                                </false>
                                            </check>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffContact">Email / Phone Number</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getEmail()}} == '' && {{@Staff->getPhoneNumber()}} == ''">
                                                <true>
                                                    <input class="form-control" type="text" name="staffContact" required>
                                                </true>
                                                <false>
                                                    <check if="{{@Staff->getEmail()}} == ''">
                                                        <true>
                                                            <input class="form-control" type="text" name="staffContact" value="{{@Staff->getPhoneNumber()}}" required>
                                                        </true>
                                                        <false>
                                                            <check if="{{@Staff->getPhoneNumber()}} == ''">
                                                                <true>
                                                                    <input class="form-control" type="text" name="staffContact" value="{{@Staff->getEmail()}}" required>
                                                                </true>
                                                                <false>
                                                                    <input class="form-control" type="text" name="staffContact" value="{{@Staff->getEmail()}} / {{@Staff->getPhoneNumber()}}" required>
                                                                </false>
                                                            </check>
                                                        </false>
                                                    </check>
                                                </false>
                                            </check>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="staffImage">Image</label>
                                        <div class="col-sm-12">
                                            <input id="imageUpload" class="form-control" type="file" name="fileToUpload" id="fileToUpload" >
                                        </div>
                                    </div>

                                    <div id="bio" class="form-group">
                                        <label class="control-label col-sm-12" for="bio">Description</label>
                                        <div class="col-sm-12">
                                            <check if="{{@Staff->getDescription()}} == ''">
                                                <true>
                                                    <textarea class="form-control" type="text" rows="4" name="staffDescription" required></textarea>
                                                </true>
                                                <false>
                                                    <textarea class="form-control" type="text" rows="4" name="staffDescription" required>{{@Staff->getDescription()}}</textarea>
                                                </false>
                                            </check>
                                            <div class="spacer"></div>
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
    </true>
</check>