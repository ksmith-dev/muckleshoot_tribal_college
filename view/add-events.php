
<check if="{{@login}} === True && strpos({{@admin->getAdminLevel()}},Events) !== false">

    <true>
        <div class="container-fluid">
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
                        <false>

                        </false>
                    </check>
                </div>
            </div>
            <script>
                $(document).ready(function(){

                    $("#txtFromDate").datepicker({

                        numberOfMonths: 1,
                        dateFormat:"yy-mm-dd",
                        onSelect: function(selected) {
                            $("#txtToDate").datepicker("option","minDate", selected)
                        }
                    });

                    $("#txtToDate").datepicker({
                        numberOfMonths: 1,
                        dateFormat:"yy-mm-dd",
                        onSelect: function(selected) {
                            $("#txtFromDate").datepicker("option","maxDate", selected)
                        }
                    });
                });
            </script>
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                    <check if="{{@Event}} == null">
                        <true>
                            <div class="col-sm-12 ">
                                <div class="page-header">
                                    <h2>Create an Event</h2>
                                </div>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="eventName">Event Name:</label>
                                    <input type="text" class="form-control" id="eventName" name="eventName" required>
                                </div>

                                <div class="form-group">
                                    <label for="Category">Event Category:</label>
                                    <input type="text" class="form-control" id="Category" name="Category" required>
                                </div>
                                <div class="form-group">
                                    <label for="dateStart">Date Start (YYYY-MM-DD):</label>
                                    <input type="text" class="form-control" id="txtFromDate" name="dateStart" required>
                                </div>

                                <div class="form-group">
                                    <label for="dateEnd">Date End (YYYY-MM-DD):</label>
                                    <input type="text" class="form-control" id="txtToDate" name="dateEnd" required>
                                </div>

                                <div class="form-group">
                                    <label for="Times">Times:</label>
                                    <input type="text" class="form-control" id="Times" name="Times" required>
                                </div>

                                <div class="form-group">
                                    <label for="Location">Location:</label>
                                    <input type="text" class="form-control" id="Location" name="Location">
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="priority">Priority: </label>
                                    <div class="col-sm-12">
                                        <input type="radio" name="priority"  id="priority" value="1" checked> 1 - Lowest <br>
                                        <input type="radio" name="priority"  id="priority" value="2"> 2 - Mid <br>
                                        <input type="radio" name="priority"  id="priority" value="3"> 3 - Highest
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="spacer"> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="fileToUpload">Image</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" accept=".png,.jpg,.jpeg">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="spacer"> </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Event Description:</label>
                                    <textarea rows="8" type="text" class="form-control" id="description"
                                              name="description" required></textarea>
                                </div>

                                <div class="col-xs-offset-5 col-sm-6">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                    <div class="spacer"></div>
                                </div>
                            </form>
                        </true>
                        <false>
                            <div class="col-sm-12 ">
                                <div class="page-header">
                                    <h2>Edit Events</h2>
                                </div>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="eventName">Event Name</label>
                                    <div class="col-sm-12">
                                        <check if="strlen({{@Event->getEventName()}}) == 0">
                                            <true>
                                                <input class="form-control" type="text" name="eventName" required>
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" name="eventName" value="{{@Event->getEventName()}}" required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="Category">Category</label>
                                    <div class="col-sm-12">
                                        <check if="strlen({{@Event->getEventCategory()}}) == 0">
                                            <true>
                                                <input class="form-control" type="text" name="Category">
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" name="Category" value="{{@Event->getEventCategory()}}" required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="dateStart">Date Start (YYYY-MM-DD):</label>
                                    <div class="col-sm-12">
                                        <check if="strlen({{@Event->getEventStartDate()}}) ==  0">
                                            <true>
                                                <input class="form-control" type="text"  id="txtFromDate"  name="dateStart" required>
                                            </true>
                                            <false>
                                                <input class="form-control" type="text"  id="txtFromDate"  name="dateStart" value="{{@Event->getEventStartDate()}}" required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="dateEnd">Date End (YYYY-MM-DD):</label>
                                    <div class="col-sm-12">
                                        <check if="strlen({{@Event->getEventEndDate()}}) == 0">
                                            <true>
                                                <input class="form-control" type="text"  id="txtFromDate"  name="dateEnd" required>
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" id="txtToDate" name="dateEnd" value="{{@Event->getEventEndDate()}}" required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="Times">Times</label>
                                    <div class="col-sm-12">
                                        <check if="strlen({{@Event->getEventTimes()}}) == 0">
                                            <true>
                                                <input class="form-control" type="text" name="Times" required>
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" name="Times" value="{{@Event->getEventTimes()}}" required>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="Location">Location</label>
                                    <div class="col-sm-12">
                                        <check if="strlen({{@Event->getEventLocation()}}) == 0">
                                            <true>
                                                <input class="form-control" type="text" name="Location" >
                                            </true>
                                            <false>
                                                <input class="form-control" type="text" name="Location" value="{{@Event->getEventLocation()}}" >
                                            </false>
                                        </check>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="priority">Priority: </label>
                                    <div class="col-sm-12">
                                        <check if="{{@Event->getPriority()}} == 1">
                                            <true>
                                                <input type="radio" name="priority"  id="priority" value="1" checked> 1 - Lowest <br>
                                            </true>
                                            <false>
                                                <input type="radio" name="priority"  id="priority" value="1"> 1 - Lowest <br>
                                            </false>
                                        </check>

                                        <check if="{{@Event->getPriority()}} == 2">
                                            <true>
                                                <input type="radio" name="priority"  id="priority" value="2" checked> 2 - Mid <br>
                                            </true>
                                            <false>
                                                <input type="radio" name="priority"  id="priority" value="2"> 2 - Mid <br>
                                            </false>
                                        </check>

                                        <check if="{{@Event->getPriority()}} == 3">
                                            <true>
                                                <input type="radio" name="priority"  id="priority" value="3" checked> 3 - Highest
                                            </true>
                                            <false>
                                                <input type="radio" name="priority"  id="priority" value="3"> 3 - Highest
                                            </false>
                                        </check>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="fileToUpload">Image</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" accept=".png,.jpg,.jpeg">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="description">Description</label>
                                    <div class="col-sm-12">
                                        <check if="strlen({{@Event->getEventDescription()}}) == 0">
                                            <true>
                                                <textarea rows="8" class="form-control" type="text" name="description" required></textarea>
                                            </true>
                                            <false>
                                                <textarea rows="8" class="form-control" type="text" name="description" required>{{@Event->getEventDescription()}}</textarea>
                                            </false>
                                        </check>
                                    </div>
                                </div>

                                <div class="col-xs-offset-5 col-sm-6">
                                    <div class="spacer"></div>
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </div>
                            </form>
                        </false>
                    </check>


                </div>
            </div>
        </div>
    </true>
    <false></false>
    </check>
    <div class="spacer-lg">
    </div>


