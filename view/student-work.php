<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-1">
            <div class="page-header">
                <h1>Muckleshoot Tribal Student Works</h1>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-offset-1 col-sm-10">
                <p>DISCLAIMER These are student course projects. Views expressed and contents presented in these projects are those
                    of students ONLY. Professor of the courses are not responsible
                    for any of the views or contents in these projects. The enclosed document does
                    not necessarily represent the views of Muckleshoot Tribal College or any other individuals referenced or acknowledged
                    within the document. These documents are not be altered, used, or distributed without the author consent.  These
                documents are for educational purposes only.</p>
                <hr/>
                <table id="studentWorkTable" class="table table-striped">
                    <thead><tr><th>Student</th><th>Project</th><th>Description</th><th>File</th></tr></thead>
                    <tbody>
                    <repeat group="{{ @projects }}" value="{{ @project }}">
                        <tr>
                            <td>{{ @project->getStudentName() }}</td>
                            <td>{{ @project->getProjectName() }}</td>
                            <td>{{ @project->getProjectDescription() }}</td>
                            <td><a href="{{@project->getProjectFilePath()}}" download>Download Project</a></td>
                        </tr>
                    </repeat>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#studentWorkTable').dataTable( {
        "lengthMenu": [ 10, 20, 50, 75, 100 ],
        "lengthChange": true,
        "pageLength": 10,
    } )});
</script>