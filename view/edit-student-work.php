<check if="{{@login}} === True && strpos({{@admin->getAdminLevel()}}, StudentWork) !== false">
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
            <div class="col-sm-12">
                <check if="{{@project}} == null">
                    <true>
                        <div class="col-sm-offset-1 col-sm-6">
                            <div class="page-header">
                                <h1>Add A New Student Project</h1>
                            </div>
                        </div>
                        <div class="col-sm-offset-3 col-sm-6">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="studentName">Name</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="studentName" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="projectName">Project Name</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="projectName">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="projectDescription">Project Description</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" type="text" rows="4" name="projectDescription" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="projectFilePath">File</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" required>
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
                                <h1>
                                    Update {{@project->getProjectName()}}
                                </h1>
                            </div>
                        </div>
                        <div class="col-sm-offset-3 col-sm-6">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="studentName">Name</label>
                                    <div class="col-sm-12">
                                        <check if="{{@project->getStudentName()}} == ''">
                                            <true>
                                                <input class="form-control" type="text" name="studentName" required>
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" name="studentName" value="{{@project->getStudentName()}}"required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="projectName">Project Name</label>
                                    <div class="col-sm-12">
                                        <check if="{{@project->getProjectName()}} == ''">
                                            <true>
                                                <input class="form-control" type="text" name="projectName" required>
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" name="projectName" value="{{@project->getProjectName()}}" required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="projectDescription">Project Description</label>
                                    <div class="col-sm-12">
                                        <check if="{{@project->getProjectDescription()}} == ''">
                                            <true>
                                                <textarea class="form-control" type="text" rows="4" name="projectDescription" required></textarea>
                                            </true>
                                            <false>
                                                <textarea class="form-control" type="text" rows="4" name="projectDescription" required>{{@project->getProjectDescription()}}</textarea>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="projectFilePath">File</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
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
</check>