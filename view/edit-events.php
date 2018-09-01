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
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="page-header">
                <h2>Editing Events</h2>
            </div>
        </div>
        <div class="col-xs-8 col-xs-offset-2">
            <form action="{{@BASE}}/edit-events/{{@id}}" method="post">
                <div class="form-group">
                    <label for="eventName">Event Name:</label>
                    <input type="text" class="form-control" id="eventName"
                           name="eventName" value="{{@event->getEventName()}}">
                </div>
                    
                <div class="form-group">
                    <label for="description">Event Description:</label>
                    <textarea rows="8" type="text" class="form-control" id="description"
                              name="description">{{@event->getEventDescription()}}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="description">Date Start (YYYY-MM-DD):</label>
                    <input type="text" class="form-control" id="dateStart"
                           name="dateStart" value="{{@event->getEventStartDate()}}">
                </div>
                
                <div class="form-group">
                    <label for="description">Date End (YYYY-MM-DD):</label>
                    <input type="text" class="form-control" id="dateEnd"
                           name="dateEnd" value="{{@event->getEventEndDate()}}">
                </div>

                <div class="col-xs-offset-5 col-sm-6">
                    <div class="spacer"></div>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <div class="spacer-lg"></div>
</div>