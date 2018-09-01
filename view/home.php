<div class="container-fluid">
    <div id="carousel-event" class="row">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <loop from="{{ @i=1 }}" to="{{ @i <= @eventSize }}" step="{{ @i++ }}">
                    <check if="{{@i}} == 1">
                        <true>
                            <li data-target="#carousel" data-slide-to="0" class="active"></li>
                        </true>
                        <false>
                            <li data-target="#carousel" data-slide-to="{{@i}}"></li>
                        </false>
                    </check>
                </loop>
            </ol>

            <!-- Wrapper for slides -->

            <div class="carousel-inner" role="listbox">
                <loop from="{{ @i=1 }}" to="{{ @i <= @eventSize }}" step="{{ @i++ }}">
                    <check if="{{@i}} == 1">
                        <true>
                            <div class="item active">
                        </true>
                        <false>
                            <div class="item">
                        </false>
                    </check>

                    <check if="{{@events[@i]->getId()}} == 0">
                        <true>
                            <!-- If there are no current or active events this is what the carousel will route to when clicked-->
                            <a class="eventLink" href="{{@BASE}}/History">
                        </true>
                        <false>
                            <a class="eventLink" href="{{@BASE}}/events/{{@events[@i]->getId()}}">
                        </false>
                    </check>

                        <div class="image-control">
                            <img src="{{@BASE}}/{{@events[@i]->getEventPhoto()}}" alt="Event Photo" class="carImg img-responsive">
                            <div class="carousel-caption">
                                <h2 class="eventText">{{@events[@i]->getEventName()}}</h2>
                                <p class="eventText"> {{@events[@i]->getEventDescription()}}</p>
                            </div>
                        </div>

                    </a>

            </div>
            </loop>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div id="resources" class="col-sm-12">
    <div class="row">
        <div class="page-header">
            <a href="{{@BASE}}/resources"><h2>Resources</a></h2></a>
        </div>
        <div class="col-sm-12">
            <div class="col-md-offset-1 col-md-9">
                <repeat group="{{ @resources }}" value="{{ @resource }}">
                    <div class="backgroundContain resourceBox col-xs-offset-1 col-xs-3">
                        <div class="row">
                            <div class="col-sm-12 col-xs-7">
                                <h3>{{@resource->getResourceName()}}</h3>
                                <hr/>
                                <p>{{@resource->getResourceDescription()}}</p>
                            </div>
                        </div>
                    </div>
                </repeat>
            </div>
        </div>
    </div>
    <div class="spacer-lg"></div>
</div>
</div>
