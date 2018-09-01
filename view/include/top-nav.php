<nav class="navbar navbar-default" id="top-nav">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="row">
                <div class="col-xs-12">
                    <a class="navbar-brand" href="{{@BASE}}/">
                        <img class="img-responsive" src="{{@BASE}}/asset/img/muckleshoot_nav.jpg">
                    </a>
                    <p id="quote"><i>"Our elders are our first teachers." - Pasty Whitefoot, Yakama</i></p>
                </div>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse  navbar-right" id="navbar-collapse">
            <ul  id="mNav" class="nav navbar-nav">
                <li class="headTab"><a href="{{@BASE}}/">Home <span class="sr-only">(current)</span></a></li>
                <li class="headTab"><a href="{{@BASE}}/Partners">Partners</a></li>
                <li class="headTab dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Academics<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{@BASE}}/Programs">Programs</a></li>
                        <li><a href="{{@BASE}}/resources">Resources</a></li>
                    </ul>
                </li>
                <li class="headTab dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Get Started <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{@BASE}}/Advising">Advising</a></li>
                        <li><a href="{{@BASE}}/Financial_Aid">Financial Aid</a></li>
                        <li><a href="{{@BASE}}/Apply">Apply Online</a></li>
                    </ul>
                </li>
                <li class="headTab dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{@BASE}}/Contact_Us">Contact Us</a></li>
                        <li><a href="{{@BASE}}/events">Events</a></li>
                        <li><a href="{{@BASE}}/History">History</a></li>
                        <li><a href="{{@BASE}}/Staff">Staff</a></li>
                        <li><a href="{{@BASE}}/Student_Work">Student Work</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    <div class="spacer"></div>
</nav>
<check if="$_SESSION['login'] == True">
    <true>
        <nav id="adminNav" class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a id="adminWelcome" class="navbar-brand" href="#">Hello {{@admin->getAdminUsername()}} </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="adminLinks" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{@BASE}}/Admin">Admin Home</a></li>
                        <li><a href="{{@BASE}}/Applied">Student Applications</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{@BASE}}/logout">Logout</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
    </true>
</check>