<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <check if="{{strpos(@admin->getAdminLevel(), Alerts) !== false}}">
                <true>
                    <button class="accordion">Manage Alerts</button>
                    <div class="panel adminPanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-xs-2">
                                    <br/>
                                    <a href="{{@BASE}}/Admin/add-alert" class="addBtn">Add Alert</a>
                                    <br/>
                                    <br/>
                                    <button class="addBtn tablinks">Active Alerts</button>
                                    <br/>
                                    <button class="addBtn tablinks">Inactive Alerts</button>
                                </div>
                                <div id="activeAlerts" class="tabcontent col-sm-10">
                                    <table class="table table-striped">
                                        <thead><th>Alert</th><th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                        <repeat group="{{ @activeAlerts }}" value="{{ @alert }}">
                                            <tr>
                                                <td>{{ @alert->getAlertName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/edit-alert/{{ @alert->getAlertId() }}">Update</a></td>
                                                <td><a href="{{@BASE}}/Admin/delete-alert/{{ @alert->getAlertId() }}">Remove</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="inactiveAlerts" class="tabcontent col-sm-10">
                                    <table class="table table-striped">
                                        <thead><th>Alert</th><th>Reactivate</th></thead>
                                        <tbody>
                                        <repeat group="{{ @inactiveAlerts }}" value="{{ @alert }}">
                                            <tr>
                                                <td>{{ @alert->getAlertName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/reactivate-alert/{{ @alert->getAlertId() }}">Reactivate</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </true>
            </check>

            <check if="{{strpos(@admin->getAdminLevel(),Events)}} !== false">
                <true>
                    <button class="accordion">Manage Events</button>
                    <div class="panel adminPanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-xs-2">
                                    <br/>
                                    <a href="{{@BASE}}/Admin/add-events" class="addBtn">Add Event</a>
                                    <br/>
                                    <br/>
                                    <button class="addBtn tablinks">Active Events</button>
                                    <br/>
                                    <button class="addBtn tablinks">Inactive Events</button>
                                </div>
                                <div id="activeEvents" class="tabcontent col-sm-10">
                                    <table class="table table-striped">
                                        <thead><th>Event</th><th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                            <repeat group="{{ @activeEvents }}" value="{{ @event }}">
                                                <tr>
                                                    <td>{{ @event->getEventName() }}</td>
                                                    <td><a href="{{@BASE}}/Admin/edit-events/{{ @event->getId() }}">Update</a></td>
                                                    <td><a href="{{@BASE}}/Admin/delete-events/{{ @event->getId() }}">Remove</a></td>
                                                </tr>
                                            </repeat>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="inactiveEvents" class="tabcontent col-sm-10">
                                    <table class="table table-striped">
                                        <thead><th>Event</th><th>Reactivate</th></thead>
                                        <tbody>
                                        <repeat group="{{ @inactiveEvents }}" value="{{ @event }}">
                                            <tr>
                                                <td>{{ @event->getEventName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/reactivate-events/{{ @event->getId() }}">Reactivate</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </true>
            </check>

            <check if="{{strpos(@admin->getAdminLevel(),FinancialAid)}} !== false">
                <true>
                    <button class="accordion">Manage Financial Aid</button>
                    <div class="panel adminPanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-xs-2">
                                    <br/>
                                    <a href="{{@BASE}}/Admin/add-financial-aid" class="addBtn">Add Financial Aid</a>
                                    <br/>
                                    <br/>
                                    <button class="addBtn tablinks">Active Financial Aid</button>
                                    <br/>
                                    <button class="addBtn tablinks">Inactive Financial Aid</button>
                                </div>
                                <div id="activeAid" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Financial Aid</th><th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                        <repeat group="{{ @activeAid }}" value="{{ @financial }}">
                                            <tr>
                                                <td>{{ @financial->getResourceName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/edit-financial-aid/{{ @financial->getResourceID() }}">Update</a></td>
                                                <td><a href="{{@BASE}}/Admin/delete-financial-aid/{{ @financial->getResourceID() }}">Remove</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="inactiveAid" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Financial Aid</th><th>Reactivate</th></thead>
                                        <tbody>
                                        <repeat group="{{ @inactiveAid }}" value="{{ @financial }}">
                                            <tr>
                                                <td>{{ @financial->getResourceName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/reactivate-financial-aid/{{ @financial->getResourceID() }}">Reactivate</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </true>
            </check>

            <check if="{{strpos(@admin->getAdminLevel(),Partners)}} !== false">
                <true>
                   <button class="accordion">Manage Partners</button>
                    <div class="panel adminPanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-xs-2">
                                    <br/>
                                    <a href="{{@BASE}}/Admin/add-partner" class="addBtn">Add Partners</a>
                                    <br/>
                                    <br/>
                                    <button class="addBtn tablinks">Active Partners</button>
                                    <br/>
                                    <button class="addBtn tablinks">Inactive Partners</button>
                                </div>
                                <div id="activePartners" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Partner</th><th>Sub Title<th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                            <repeat group="{{ @activePartners }}" value="{{ @Partner }}">
                                                <tr>
                                                    <td>{{ @Partner->getTitle() }}</td>
                                                    <td>{{ @Partner->getSubTitle() }}</td>
                                                    <td><a href="{{@BASE}}/Admin/edit-partner/{{ @Partner->getId() }}">Update</a></td>
                                                    <td><a href="{{@BASE}}/Admin/delete-partner/{{ @Partner->getId() }}">Remove</a></td>
                                                </tr>
                                            </repeat>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="inactivePartners" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Partner</th><th>Sub Title</th><th>Reactivate</th></thead>
                                        <tbody>
                                        <repeat group="{{ @inactivePartners }}" value="{{ @Partner }}">
                                            <tr>
                                                <td>{{ @Partner->getTitle() }}</td>
                                                <td>{{ @Partner->getSubTitle() }}</td>
                                                <td><a href="{{@BASE}}/Admin/reactivate-partner/{{ @Partner->getId() }}">Reactivate</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </true>
            </check>

            <check if="{{strpos(@admin->getAdminLevel(),Programs)}} !== false">
                <true>
                    <button class="accordion">Manage Programs</button>
                    <div class="panel adminPanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-xs-2">
                                    <br/>
                                    <a href="{{@BASE}}/Admin/add-program" class="addBtn">Add Program</a>
                                    <br/>
                                    <br/>
                                    <button class="addBtn tablinks">Active Programs</button>
                                    <br/>
                                    <button class="addBtn tablinks">Inactive Programs</button>
                                </div>
                                <div id="activePrograms" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Program</th><th>Sub Title</th><th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                        <repeat group="{{ @activePrograms }}" value="{{ @Program }}">
                                            <tr>
                                                <td>{{ @Program->getTitle() }}</td>
                                                <td>{{ @Program->getSubTitle() }}</td>
                                                <td><a href="{{@BASE}}/Admin/edit-program/{{ @Program->getId() }}">Update</a></td>
                                                <td><a href="{{@BASE}}/Admin/delete-program/{{ @Program->getId() }}">Remove</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="inactivePrograms" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Program</th><th>Sub Title</th><th>Reactivate</th></thead>
                                        <tbody>
                                        <repeat group="{{ @inactivePrograms }}" value="{{ @Program }}">
                                            <tr>
                                                <td>{{ @Program->getTitle() }}</td>
                                                <td>{{ @Program->getSubTitle() }}</td>
                                                <td><a href="{{@BASE}}/Admin/reactivate-program/{{ @Program->getId() }}">Reactivate</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </true>
            </check>

            <check if="{{strpos(@admin->getAdminLevel(),Resources)}} !== false">
                <true>
                    <button class="accordion">Manage Resources</button>
                    <div class="panel adminPanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-xs-2">
                                    <br/>
                                    <a href="{{@BASE}}/Admin/add-resources" class="addBtn">Add Resource</a>
                                    <br/>
                                    <br/>
                                    <button class="addBtn tablinks">Active Resources</button>
                                    <br/>
                                    <button class="addBtn tablinks">Inactive Resources</button>
                                </div>
                                <div id="activeResources" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Resource</th><th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                        <repeat group="{{ @activeResources }}" value="{{ @resource }}">
                                            <tr>
                                                <td>{{ @resource->getResourceName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/edit-resources/{{ @resource->getResourceId() }}">Update</a></td>
                                                <td><a href="{{@BASE}}/Admin/delete-resources/{{ @resource->getResourceId() }}">Remove</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="inactiveResources" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Resource</th><th>Reactivate</th></thead>
                                        <tbody>
                                        <repeat group="{{ @inactiveResources }}" value="{{ @resource }}">
                                            <tr>
                                                <td>{{ @resource->getResourceName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/reactivate-resources/{{ @resource->getResourceId() }}">Reactivate</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </true>
            </check>

            <check if="{{strpos(@admin->getAdminLevel(),Staff)}} !== false">
                <true>
                    <button class="accordion">Manage Staff</button>
                    <div class="panel adminPanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-xs-2">
                                    <br/>
                                    <a href="{{@BASE}}/Admin/add-staff" class="addBtn">Add Staff</a>
                                    <br/>
                                    <br/>
                                    <button class="addBtn tablinks">Active Staff</button>
                                    <br/>
                                    <button class="addBtn tablinks">Inactive Staff</button>
                                </div>
                                <div id="activeStaff" class="tabcontent col-sm-10">
                                    <table class="table table-striped">
                                        <thead><th>Name</th><th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                        <repeat group="{{ @activeStaff }}" value="{{ @Employee }}">
                                            <tr>
                                                <td>{{ @Employee->getFirstName() }} {{ @Employee->getLastName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/edit-staff/{{ @Employee->getBioId() }}">Update</a></td>
                                                <td><a href="{{@BASE}}/Admin/delete-staff/{{ @Employee->getBioId() }}">Remove</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="inactiveStaff" class="tabcontent col-sm-10">
                                    <table class="table table-striped">
                                        <thead><th>Name</th><th>Reactivate</th></thead>
                                        <tbody>
                                        <repeat group="{{ @inactiveStaff }}" value="{{ @Employee }}">
                                            <tr>
                                                <td>{{ @Employee->getFirstName() }} {{ @Employee->getLastName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/reactivate-staff/{{ @Employee->getBioId() }}">Reactivate</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </true>
            </check>

            <check if="{{strpos(@admin->getAdminLevel(),StudentWork)}} !== false">
                <true>
                    <button class="accordion">Manage Student Work</button>
                    <div class="panel adminPanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-xs-2">
                                    <br/>
                                    <a href="{{@BASE}}/Admin/add-student-work" class="addBtn">Add Student Work</a>
                                    <br/>
                                    <br/>
                                    <button class="addBtn tablinks">Active Student Work</button>
                                    <br/>
                                    <button class="addBtn tablinks">Inactive Student Work</button>
                                </div>
                                <div id="activeStudentWork" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Student</th><th>Project</th><th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                        <repeat group="{{ @activeProjects }}" value="{{ @project }}">
                                            <tr>
                                                <td>{{ @project->getStudentName() }}</td>
                                                <td>{{ @project->getProjectName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/edit-student-work/{{ @project->getProjectId() }}">Update</a></td>
                                                <td><a href="{{@BASE}}/Admin/delete-student-work/{{ @project->getProjectId() }}">Remove</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="inactiveStudentWork" class="tabcontent col-sm-9">
                                    <table class="table table-striped">
                                        <thead><th>Student</th><th>Project</th><th>Reactivate</th></thead>
                                        <tbody>
                                        <repeat group="{{ @inactiveProjects }}" value="{{ @project }}">
                                            <tr>
                                                <td>{{ @project->getStudentName() }}</td>
                                                <td>{{ @project->getProjectName() }}</td>
                                                <td><a href="{{@BASE}}/Admin/reactivate-student-work/{{ @project->getProjectId() }}">Reactivate</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </true>
            </check>

            <check if="{{strpos(@admin->getAdminLevel(),Users)}} !== false">
                <true>
                    <button class="accordion">Manage Users</button>
                    <div class="panel adminPanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-xs-2">
                                    <br/>
                                    <a href="{{@BASE}}/Admin/add-users" class="addBtn">Add User</a>
                                    <br/>
                                    <br/>
                                    <button class="addBtn tablinks">Active Users</button>
                                    <br/>
                                    <button class="addBtn tablinks">Inactive Users</button>
                                </div>
                                <div id="activeUsers" class="tabcontent col-sm-10">
                                    <table class="table table-striped">
                                        <thead><th>Name</th><th>Admin Level</th><th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                        <repeat group="{{ @activeAdmins }}" value="{{ @admin }}">
                                            <tr>
                                                <td>{{ @admin->getAdminUsername() }}</td>
                                                <td>{{ @admin->getAdminLevel() }}</td>
                                                <td><a href="{{@BASE}}/Admin/edit-users/{{ @admin->getAdminId() }}">Update</a></td>
                                                <td><a href="{{@BASE}}/Admin/delete-users/{{ @admin->getAdminId() }}">Remove</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="inactiveUsers" class="tabcontent col-sm-10">
                                    <table class="table table-striped">
                                        <thead><th>Name</th><th>Admin Level</th><th>Update</th><th>Remove</th></thead>
                                        <tbody>
                                        <repeat group="{{ @inactiveAdmins }}" value="{{ @admin }}">
                                            <tr>
                                                <td>{{ @admin->getAdminUsername() }}</td>
                                                <td>{{ @admin->getAdminLevel() }}</td>
                                                <td><a href="{{@BASE}}/Admin/reactivate-users/{{ @admin->getAdminId() }}">Reactivate</a></td>
                                            </tr>
                                        </repeat>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="spacer-lg"></div>
                    </div>
                </true>
            </check>
            <check if="{{@accessCount == 0}}">
                <true>
                    <div class="col-sm-offset-4 col-sm-4">
                        <div class="panel panel-body">
                            <h2>You do not have permission to manage the website</h2>
                            <h3>Please speak to an administrator</h3>
                        </div>
                    </div>
                </true>
            </check>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{@BASE}}/asset/js/adminTabs.js"></script>
<script src="{{@BASE}}/asset/js/accordion.js"></script>