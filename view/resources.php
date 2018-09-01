<div class="container-fluid">
    <div class="spacer"></div>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 page-header">
            <h1> RESOURCES AVAILABLE THROUGH THE COLLEGE </h1>

        </div>
        <div class="col-sm-12">
            <div class="spacer"></div>
        </div>
        <div id="aidList" class="col-sm-offset-1 col-sm-10">
            <loop from="{{@i=0}}" to="{{@i<@resourcesSize}}" step="{{@i++}}">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>{{@resourcesByActive[@i]->getResourceName()}}</h2>
                    </div>
                    <div class="col-sm-12">
                        <p>{{@resourcesByActive[@i]->getResourceDescription()}}</p>
                    </div>
                </div>
                <!--Check if there is a link with this resources if yes than print out the link-->
                <check if="strlen({{@resourcesByActive[@i]->getResourceLink()}}) ==  0">
                    <true>
                    </true>
                    <false>
                        <p><a href="{{@resourcesByActive[@i]->getResourceLink()}}" target="_blank">Click here for more information</a></p>
                    </false>
                </check>
                <!--Check if there is any contact inot then print it out-->
                <check if="strlen({{@resourcesByActive[@i]->getResourceContactName()}}) ==  0 &&
                strlen({{@resourcesByActive[@i]->getResourceContactPhone()}}) ==  0 &&
                strlen({{@resourcesByActive[@i]->getResourceContactEmail()}}) ==  0">
                    <true>
                    </true>
                    <false>
                        <p><strong>If you have any questions please contact:</strong></p>
                        <p>
                            <check if="strlen({{@resourcesByActive[@i]->getResourceContactName()}}) >  0">
                                <true>
                                    {{@resourcesByActive[@i]->getResourceContactName()}} <br>
                                </true>
                                <false>
                                </false>
                            </check>

                            <check if="strlen({{@resourcesByActive[@i]->getResourceContactPhone()}}) >  0">
                                <true>
                                    Phone Number: {{@resourcesByActive[@i]->getResourceContactPhone()}} <br>
                                </true>
                                <false>
                                </false>
                            </check>

                            <check if="strlen({{@resourcesByActive[@i]->getResourceContactEmail()}}) >  0">
                                <true>
                                    Email: <a href="mailto:{{@resourcesByActive[@i]->getResourceContactEmail()}}">{{@resourcesByActive[@i]->getResourceContactEmail()}}</a>
                                      <br>
                                </true>
                                <false>
                                </false>
                            </check>
                        </p>
                    </false>
                </check>
                <!--Keep adding an <hr> until
                    the last financial aid item-->
                <check if="{{@i}} == @resourcesSize -1">
                    <true>
                    </true>
                    <false>
                        <hr>
                    </false>
                </check>
            </loop>
        </div>
    </div>
    <div class="spacer-lg"></div>
</div>
