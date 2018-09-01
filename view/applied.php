<check if="{{@login}} === True">
    <true>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="spacer"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            College Applicants
                        </div>
                        <div class="panel-body">
                            <table id="applied" class="table table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>E-Mail</th>
                                    <th>Birthdate</th>
                                </thead>
                                <tbody>
                                    <repeat group="{{ @applicants }}" value="{{ @applicant }}">
                                        <tr>
                                            <td>{{@applicant->getID()}}</td>
                                            <td>{{@applicant->getFirstName()}}</td>
                                            <td>{{@applicant->getLastName()}}</td>
                                            <td>{{@applicant->getEmail()}}</td>
                                            <td>{{@applicant->getBirthDate()}}</td>
                                        </tr>
                                    </repeat>
                                </tbody>
                            </table>
                        </div> <!-- end panel-body -->
                    </div>
                </div>
            </div>
        </div>
    </true>
</check>
<script>
    $(document).ready(function() {
        $('#applied').dataTable( {
            "lengthMenu": [ 10, 20, 50, 75, 100 ],
            "lengthChange": true,
            "pageLength": 10,
        } )});
</script>