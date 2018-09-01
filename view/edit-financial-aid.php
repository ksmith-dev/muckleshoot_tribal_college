<div class="container-fluid">
    <div class="spacer-lg"></div>
    <check if="{{@edit_result}}">
        <true>{{@edit-result}}</true>
    </check>
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="page-header">
                <h2>Editing {{@resource->getResourceName()}}</h2>
            </div>
        </div>
        <div class="col-xs-8 col-xs-offset-2">
            <form action="{{@BASE}}/edit-financial-aid/{{@id}}" method="post">
                <div class="form-group">
                    <label for="resource_name">Resource Name:</label>
                    <input type="text" class="form-control" id="resource_name"
                           name="resource_name" value="{{@resource->getResourceName()}}">
                </div>
                <div class="form-group">
                    <label for="resource_info">Resource Info:</label>
                    <textarea rows="8" type="text" class="form-control" id="resource_info"
                              name="resource_info">{{@resource->getResourceInfo()}}</textarea>
                </div>
                <div class="form-group">
                    <label for="resource_link">Resource Link:</label>
                    <input type="text" class="form-control" id="resource_link"
                           name="resource_link" value="{{@resource->getResourceLink()}}">
                </div>
                <input type="submit" class="btn btn-default" value="Submit">
            </form>
        </div>
    </div>
    <div class="spacer-lg"></div>
</div>