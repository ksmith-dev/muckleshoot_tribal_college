<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-xs-8 col-xs-offset-1">
                <div class="page-header">
                    <h1>Muckleshoot Tribal Staff</h1>
                </div>
            </div>
            <div id="staffList" class="col-sm-12">
                <div class="row">
                    <loop from="{{ @i=0 }}" to="{{ @i < @staffsize }}" step="{{ @i++ }}">
                        <check if="{{@i == 0}}">
                            <false>
                                <check if="{{@i % 2 == 0}}">
                                    <true>
                </div>
                <div class="row">
                    </true>
                    </check>
                    </false>
                    </check>
                    <div class="col-xs-6">
                        <div class="innerBox col-xs-12">
                            <div class="col-xs-5">
                                <div class="staffImg col-xs-12">
                                    <img class="img-responsive" src="{{@staff[@i]->getPhotoPath()}}" />
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="staffInfo col-xs-12">
                                    <h3>{{@staff[@i]->getTitle()}} {{@staff[@i]->getFirstName()}} {{@staff[@i]->getLastName()}}</h3>
                                    <p>{{@staff[@i]->getCredentials()}}</p>
                                    <p>{{@staff[@i]->getDepartment()}}</p>
                                    <p>{{@staff[@i]->getJobTitle()}}</p>
                                    <p>{{@staff[@i]->getLocation()}}</p>
                                    <p>{{@staff[@i]->getPhoneNumber()}}</p>
                                    <p>{{@staff[@i]->getEmail()}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="spacer"></div>
                                    <hr/>
                                    <p class="staffBio" >{{@staff[@i]->getDescription()}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </loop>
                </div>
            </div>
        </div>
    </div>
</div>