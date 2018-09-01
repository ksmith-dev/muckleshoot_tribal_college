<div class = "container-fluid">
    <div class="spacer" ></div>
    <div class = "row ">
        <div class = "col-sm-10  col-sm-offset-1">
            <h1>MUCKLESHOOT TRIBAL COLLEGE EVENTS</h1>
        </div>

    </div>
    <div class="spacer-lg" ></div>
    <div class = "row ">


        <check if="{{@eventById}} == false">
            <true>
                <div class = "col-sm-3  col-sm-offset-1" id="eventsidebarhome">
                    <h2 id ="headerupcomingevents">Upcoming Events</h2>
                    <div id="eventBoxScroll" class = "col-sm-12">
                        <loop from="{{ @i=0 }}" to="{{ @i < @eventSize}}" step="{{ @i++ }}">
                            <a href="{{@BASE}}/events/{{@eventsByActive[@i]->getId()}}">
                                <div id="eventBox" class = "col-sm-12 ">
                                    <p><b><>{{@eventByActive[@i]->getEventStartDate()}}</b> </p>
                                    <p><b>{{@eventsByActive[@i]->getEventName()}}</b></p>
                                </div>
                            </a>

                        </loop>
                    </div>
                </div>
                <div class = "col-sm-7" id="eventcontenthome">

                    <h2> Hello!</h2>
                    <p> Please check back often for all the latest updates! </p>
                </div>

            </true>
            <false>
                <div class = "col-sm-3  col-sm-offset-1" id="eventsidebar">
                    <h2 id ="headerupcomingevents">Upcoming Events</h2>
                    <div id="eventBoxScroll" class = "col-sm-12">
                        <loop from="{{ @i=1 }}" to="{{ @i <= @eventSize}}" step="{{ @i++ }}">
                            <a href="{{@BASE}}/events/{{@eventsByActive[@i]->getId()}}">
                                <div id="eventBox" class = "col-sm-12 ">
                                    <check if="{{@eventsByActive[@i]->getEventStartDate()}} == {{@eventsByActive[@i]->getEventEndDate()}}">
                                        <true>
                                            <p><b>{{@eventsByActive[@i]->getEventStartDate()}}</b></p>
                                        </true>
                                        <false>
                                            <p><b>{{@eventsByActive[@i]->getEventStartDate()}} - {{@eventsByActive[@i]->getEventEndDate()}}</b></p>
                                        </false>
                                    </check>

                                    <p><b>{{@eventsByActive[@i]->getEventName()}}</b></p>
                                </div>
                            </a>

                        </loop>
                    </div>
                </div>
                <div class = "col-sm-7" id="eventcontent" >

                    <div class = "row">
                        <img src="{{@BASE}}/{{@eventById->getEventPhoto()}}" alt="Event Photo" class="img-responsive" id = "eventimgsize">
                    </div>

                    <div class = "row" >
                        <h2> {{@eventById->getEventName()}} </h2>
                        <check if="{{@eventById->getEventStartDate()}} == {{@eventById->getEventEndDate()}}">
                            <true>
                                <p> <b>Date and Time:</b> {{@eventById->getEventStartDate()}} {{@eventById->getEventTimes()}}</p>
                            </true>
                            <false>
                                <p> <b>Date and Time:</b> {{@eventById->getEventStartDate()}} - {{@eventById->getEventEndDate()}} {{@eventById->getEventTimes()}}</p>
                            </false>
                        </check>

                        <p> <b>Location:</b> {{@eventById->getEventLocation()}}</p>
                        <p> <b>Category:</b> {{@eventById->getEventCategory()}}</p>
                        <p> <b>Description:</b> {{@eventById->getEventDescription()}}</p>
                    </div>
                </div>
            </false>

        </check>
    </div>
    <div class="spacer-lg" ></div>
</div>