<check if="{{@login}} === True && strpos({{@admin->getAdminLevel()}}, Resources) !== false">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <check if="{{sizeOf(@errors)}} > 0">
                    <true>
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            <p>
                                <repeat group="{{@errors}}" value="{{ @error }}">
                                    {{ @error }}
                                    <br />
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


            <check if="{{@Resource}} == null">
                <true>
                    <div class="col-sm-offset-1 col-sm-10">
                        <div class="page-header">
                        <h1>Create new resource</h1>
                        </div>
                    </div>
                    <div class="spacer"></div>
                    <div class="col-sm-offset-3 col-sm-6">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="name"> Tittle (Required):</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="contactName"> Contact Name (Optional): </label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="contactName">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="contactPhone"> Contact Phone (Optional): </label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="contactPhone">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="contactEmail"> Contact Email (Optional): </label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="contactEmail">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="link"> Link to a website (Optional): </label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="link">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-12" for="description"> Description (Required):</label>
                                <div class="col-sm-12">
                                    <textarea rows="5"  class="form-control" name="description" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>

                            <div class="col-xs-offset-5 col-sm-6">
                                <input class="btn btn-primary" type="submit" value="Submit">
                                <div class="spacer"></div>
                            </div>
                        </form>
                    </div>

                </true>



                <false>
                    <div class="col-sm-offset-1 col-sm-10">
                        <div class="page-header">
                            <h1>Edit resource</h1>
                        </div>
                    </div>

                    <div class="spacer"></div>
                    <div class="col-sm-offset-3 col-sm-6">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="name">Edit Tittle</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="name" value="{{@Resource->getResourceName()}}" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="contactName"> Contact Name (Optional): </label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="contactName" value="{{@Resource->getResourceContactName()}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="contactPhone"> Contact Phone (Optional): </label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="contactPhone" value="{{@Resource->getResourceContactPhone()}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="contactEmail"> Contact Email (Optional): </label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="contactEmail"  value="{{@Resource->getResourceContactEmail()}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="link"> Link to a website (Optional): </label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" name="link"  value="{{@Resource->getResourceLink()}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="spacer"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="description"> Edit Description </label>
                                <div class="col-sm-12">
                                    <textarea rows="5"  class="form-control" name="description" required>{{@Resource->getResourceDescription()}}</textarea>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="spacer"></div>
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
        <div class="spacer-lg"></div>

    </div>
</check>