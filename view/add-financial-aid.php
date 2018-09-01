<check if="{{@login}} === True && strpos({{@admin->getAdminLevel()}}, FinancialAid) !== false">
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
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                    <check if="{{@resource}} == null">
                        <true>
                            <div class="col-sm-10 col-sm-offset-1 page-header">
                                <h1> Add Financial Aid </h1>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="resource_name">Resource Name</label>
                                    <input type="text" class="form-control" id="resource_name" name="resource_name" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="resource_info">Resource Info</label>
                                    <textarea rows="8" type="text" class="form-control" id="resource_info"
                                              name="resource_info" required></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="resource_link">Resource Link</label>
                                    <input type="text" class="form-control" id="resource_link" name="resource_link" required>
                                </div>

                                <div class="col-xs-offset-5 col-sm-6">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                    <div class="spacer"></div>
                                </div>
                            </form>
                        </true>
                        <false>
                            <div class="col-sm-10 col-sm-offset-1 page-header">
                                <h1> Edit Financial Aid </h1>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="resource_name">Resource Name</label>
                                    <div class="col-sm-12">
                                        <check if="{{@resource->getResourceName()}} == ''">
                                            <true>
                                                <input class="form-control" type="text" name="resource_name" required>
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" name="resource_name"
                                                       value="{{@resource->getResourceName()}}" required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="resource_info">Resource Info</label>
                                    <div class="col-sm-12">
                                        <check if="{{@resource->getResourceInfo()}} == ''">
                                            <true>
                                                <textarea rows="8" class="form-control" type="text" name="resource_info" required>
                                                </textarea>
                                            </true>
                                            <false>
                                                <textarea rows="8" class="form-control" type="text" name="resource_info" required>{{@resource->getResourceInfo()}}</textarea>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="Category">Resource Link</label>
                                    <div class="col-sm-12">
                                        <check if="{{@resource->getResourceLink()}} == ''">
                                            <true>
                                                <input class="form-control" type="text" name="resource_link" required>
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" name="resource_link"
                                                       value="{{@resource->getResourceLink()}}" required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="col-xs-offset-5 col-sm-6">
                                    <div class="spacer"></div>
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                    <div class="spacer"></div>
                                </div>
                            </form>
                        </false>
                    </check>
                    
                    <div class="spacer-lg">
                    </div>
                </div>
            </div>
        </div>
    </true>
</check>