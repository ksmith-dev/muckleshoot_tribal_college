<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <div class="page-header">
                <h2>Resources that will help you pay for college</h2>
            </div>
        </div>
        <div id="aidList" class="col-sm-offset-1 col-sm-10">
            <loop from="{{ @i = 1 }}" to="{{ @i <= @numOfResources }}" step="{{ @i++ }}">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>{{@resources[@i]->getResourceName()}}</h3>
                    </div>
                    <div class="col-sm-12">
                        <p>{{@resources[@i]->getResourceInfo()}}</p>
                    </div>
                    <div class="col-sm-12">
                        <h5>
                            <a href="{{@resources[@i]->getResourceLink()}}">
                                {{@resources[@i]->getResourceLink()}}
                            </a>
                        </h5>
                    </div>
                </div>
                
                <!--Keep adding an <hr> until
                    the last financial aid item-->
                <check if="{{@i}} == @numOfResources">
                    <true>
                    </true>
                    <false>
                        <hr>
                    </false>
                </check>
            </loop>
        </div>
    </div>
</div>
<div class="spacer-lg"></div>