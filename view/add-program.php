<script src="{{@BASE}}/asset/js/input-filter.js"></script>
<div class="container-fluid">
    <div class="spacer-lg"></div>
    <div class="col-sm-10 col-sm-offset-1 page-header">
        <h1> Add Programs </h1>
    </div>
    <div  id="edit-container" class="row">
        <div class="col-xs-12">
            <form action="{{@BASE}}/Admin/add-program" method="post" enctype="multipart/form-data" novalidate>
                <ul class="nav nav-tabs">
                    <li id="all-tab" class="active"><a>All</a></li>
                    <li id="list-tab"><a>Lists</a></li>
                    <li id="contact-tab"><a>Contacts</a></li>
                    <li id="img-tab"><a>Images</a></li>
                    <li id="paragraph-tab"><a>Paragraphs</a></li>
                </ul>
                <div class="spacer"></div>
                <div class="form-group paragraph">
                    <label for="title">Program Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="title text">
                </div>
                <div class="form-group paragraph">
                    <label for="sub-title">Program Sub-itle:</label>
                    <input type="text" class="form-control" id="sub-title" name="sub-title" placeholder="sub-title text">
                </div>
                <div class="form-group paragraph">
                    <label for="desc-head">Heading:</label>
                    <input type="text" class="form-control" id="desc-head" name="desc-head" placeholder="heading text">
                </div>
                <div class="form-group paragraph">
                    <label for="desc-body">Paragraph:</label>
                    <textarea rows="8" type="text" class="form-control" id="desc-body" name="desc-body" placeholder="paragraph text"></textarea>
                </div>
                <div class="form-group list-tool">
                    <label for="desc-list-head">
                        <button type="button" class="btn btn-default" disabled>List Heading:</button>
                    </label>
                    <input type="text" class="form-control" id="desc-list-head" name="desc-list-head" placeholder="list heading text">
                </div>
                <div class="form-group list-tool">
                    <label for="desc-list-data">
                        <button id="super-user-info" type="button" class="btn btn-default" data-toggle="modal" data-target="#super-user-modal" style="cursor: pointer; text-decoration: none;">List Data: (click for more info)</button>
                    </label>
                    <textarea rows="8" type="text" class="form-control" id="desc-list-data" name="desc-list-data" placeholder="list data"></textarea>
                </div>
                <div class="form-group paragraph">
                    <label for="desc-footer-head">Heading:</label>
                    <input type="text" class="form-control" id="desc-footer-head" name="desc-footer-head" placeholder="heading text">
                </div>
                <div class="form-group paragraph">
                    <label for="desc-footer-body">Paragraph:</label>
                    <textarea rows="8" type="text" class="form-control" id="desc-footer-body" name="desc-footer-body" placeholder="paragraph text"></textarea>
                </div>
                <div class="form-group paragraph">
                    <label for="info-head">Heading:</label>
                    <input type="text" class="form-control" id="info-head" name="info-head" placeholder="heading text">
                </div>
                <div class="form-group paragraph">
                    <label for="info-body">Paragraph:</label>
                    <textarea rows="8" type="text" class="form-control" id="info-body" name="info-body" placeholder="paragraph text"></textarea>
                </div>
                <div class="form-group list-tool">
                    <label for="info-list-head">
                        <button type="button" class="btn btn-default" disabled>List Heading:</button>
                    </label>
                    <input type="text" class="form-control" id="info-list-head" name="info-list-head" placeholder="list heading text">
                </div>
                <div class="form-group list-tool">
                    <label for="info-list-data">
                        <button id="super-user-info" type="button" class="btn btn-default" data-toggle="modal" data-target="#super-user-modal" style="cursor: pointer; text-decoration: none;">List Data: (click for more info)</button>
                    </label>
                    <textarea rows="8"  type="text" class="form-control" id="info-list-data" name="info-list-data" placeholder="list data text"></textarea>
                </div>
                <div class="form-group paragraph">
                    <label for="info-footer-head">Heading:</label>
                    <input type="text" class="form-control" id="info-footer-head" name="info-footer-head" placeholder="heading text">
                </div>
                <div class="form-group paragraph">
                    <label for="info-footer-body">Paragraph:</label>
                    <textarea rows="8" type="text" class="form-control" id="info-footer-body" name="info-footer-body" placeholder="paragraph text"></textarea>
                </div>
                <div class="form-group paragraph">
                    <label for="footer-head">Heading:</label>
                    <input type="text" class="form-control" id="footer-head" name="footer-head" placeholder="heading text">
                </div>
                <div class="form-group paragraph">
                    <label for="footer-body">Paragraph:</label>
                    <textarea rows="8" type="text" class="form-control" id="footer-body" name="footer-body" placeholder="paragraph text"></textarea>
                </div>
                <div class="form-group contact">
                    <label for="contact-name">Contact Name:</label>
                    <input type="text" class="form-control" id="contact-name" name="contact-name" placeholder="contact's name">
                </div>
                <div class="form-group contact">
                    <label for="contact-title">Contact Title:</label>
                    <input type="text" class="form-control" id="contact-title" name="contact-title" placeholder="contact's title">
                </div>
                <div class="form-group contact">
                    <label for="contact-desc">Contact Description:</label>
                    <input type="text" class="form-control" id="contact-desc" name="contact-desc" placeholder="contact's description">
                </div>
                <div class="form-group contact">
                    <label for="contact-phone">Contact Phone:</label>
                    <input type="text" class="form-control" id="contact-phone" name="contact-phone" placeholder="(000) 000-0000">
                </div>
                <div class="form-group contact">
                    <label for="contact-email">Contact Email:</label>
                    <input type="email" class="form-control" id="contact-email" name="contact-email" placeholder="email@domain.com">
                </div>
                <div class="form-group img">
                    <label for="link">Link Path:</label>
                    <input type="text" class="form-control" id="link" name="link" placeholder="http://www.site.com">
                </div>
                <div class="form-group img">
                    <label for="link">Link Text:</label>
                    <input type="text" class="form-control" id="link-text" name="link-text" placeholder="link text">
                </div>
                <div class="form-group img">
                    <label for="usr-file-upload">Upload Program Image:</label>
                    <input type="file" class="form-control" id="usr-file-upload" name="usr-file-upload">
                </div>
                <input type="submit" class="btn btn-default" value="Submit">
            </form>
        </div>
    </div>
    <div class="spacer-lg"></div>
</div>

<!-- Super User Modal -->
<div class="modal fade" id="super-user-modal" tabindex="-1" role="dialog" aria-labelledby="super-user-info-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLongTitle">ADDITIONAL INFORMATION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-danger">Attention!</h4>
                <p class="text-danger">This input requires some additional information.<br>"DO NOT TO USE" this input if you are not comfortable with the requirements.</p>
                <h5>Additional info:</h5>
                <p>To use this input to it's full potential you can use the tilde symbol (~) to separate strings into a list.</p>
                <p>Example: Sentence one~Sentence two</p>
                <p>Will print out on the page like this.</p>
                <ul>
                    <li>Sentence one</li>
                    <li>Sentence two</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>