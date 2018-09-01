<script src="{{@BASE}}/asset/js/input-filter.js"></script>
<div class="container-fluid">
    <div class="spacer-lg"></div>
    <check if="{{!empty(@editResult)}}">
        <true>
            <check if="{{@editResult == 'success'}}">
                <true>
                    <div class="alert alert-success">
                        <span><strong>Success!</strong><br>Updates to partners have been made.</span>
                    </div>
                    <div class="spacer-lg"></div>
                </true>
            </check>
            <div class="spacer"></div>
        </true>
    </check>
    <div  id="edit-container" class="row">
        <div class="col-xs-12">
            <form action="{{@BASE}}/Admin/edit-partner/{{@id}}" method="post" enctype="multipart/form-data" novalidate>
                <ul class="nav nav-tabs">
                    <li id="all-tab" class="active"><a>All</a></li>
                    <li id="list-tab"><a>Lists</a></li>
                    <li id="contact-tab"><a>Contacts</a></li>
                    <li id="img-tab"><a>Images</a></li>
                    <li id="paragraph-tab"><a>Paragraphs</a></li>
                </ul>
                <div class="spacer"></div>
                <!-- Button trigger modal -->
                <button id="show-partner-example" type="button" class="btn btn-primary" data-toggle="modal" data-target="#partner-example" style="display: block; margin: 0 auto;">
                    SHOW PARTNER EXAMPLE
                </button>
                <div class="form-group paragraph">
                    <label for="title">Partner Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{@partner->getTitle()}}" placeholder="partner title">
                </div>
                <div class="form-group paragraph">
                    <label for="sub-title">Partner Sub-title:</label>
                    <input type="text" class="form-control" id="sub-title" name="sub-title" value="{{@partner->getSubTitle()}}" placeholder="partner sub-title">
                </div>
                <div class="form-group paragraph">
                    <label for="desc-head">Heading:</label>
                    <input type="text" class="form-control" id="desc-head" name="desc-head" value="{{@partner->getDescHead()}}" placeholder="heading">
                </div>
                <div class="form-group paragraph">
                    <label for="desc-body">Paragraph Text:</label>
                    <textarea rows="8" type="text" class="form-control" id="desc-body" name="desc-body" placeholder="paragraph text">{{@partner->getDescBody()}}</textarea>
                </div>
                <div class="form-group list-tool">
                    <label for="desc-list-head">
                        <button type="button" class="btn btn-default" disabled>List Heading:</button>
                    </label>
                    <input type="text" class="form-control" id="desc-list-head" name="desc-list-head" value="{{@partner->getDescListHead()}}" placeholder="heading">
                </div>
                <div class="form-group list-tool">
                    <label for="desc-list-data">
                        <button id="super-user-info" type="button" class="btn btn-default" data-toggle="modal" data-target="#super-user-modal" style="cursor: pointer; text-decoration: none;">List Data: (click for more info)</button>
                    </label>
                    <textarea rows="8" type="text" class="form-control" id="desc-list-data" name="desc-list-data" placeholder="paragraph text">{{@desc_list_data}}</textarea>
                </div>
                <div class="form-group paragraph">
                    <label for="desc-footer-head">Heading:</label>
                    <input type="text" class="form-control" id="desc-footer-head" name="desc-footer-head" value="{{@partner->getDescFooterHead()}}" placeholder="heading">
                </div>
                <div class="form-group paragraph">
                    <label for="desc-footer-body">Paragraph Text:</label>
                    <textarea rows="8" type="text" class="form-control" id="desc-footer-body" name="desc-footer-body" placeholder="paragraph text">{{@partner->getDescFooterBody()}}</textarea>
                </div>
                <div class="form-group paragraph">
                    <label for="info-head">Heading:</label>
                    <input type="text" class="form-control" id="info-head" name="info-head" value="{{@partner->getInfoHead()}}" placeholder="heading">
                </div>
                <div class="form-group paragraph">
                    <label for="info-body">Paragraph Text:</label>
                    <textarea rows="8" type="text" class="form-control" id="info-body" name="info-body" placeholder="paragraph text">{{@partner->getInfoBody()}}</textarea>
                </div>
                <div class="form-group list-tool">
                    <label for="info-list-head">
                        <button type="button" class="btn btn-default" disabled>List Heading:</button>
                    </label>
                    <input type="text" class="form-control" id="info-list-head" name="info-list-head" value="{{@partner->getInfoListHead()}}" placeholder="heading">
                </div>
                <div class="form-group list-tool">
                    <label for="info-list-data">
                        <button id="super-user-info" type="button" class="btn btn-default" data-toggle="modal" data-target="#super-user-modal" style="cursor: pointer; text-decoration: none;">List Data: (click for more info)</button>
                    </label>
                    <textarea rows="8"  type="text" class="form-control" id="info-list-data" name="info-list-data" placeholder="paragraph text">{{@info_list_data}}</textarea>
                </div>
                <div class="form-group paragraph">
                    <label for="info-footer-head">Heading:</label>
                    <input type="text" class="form-control" id="info-footer-head" name="info-footer-head" value="{{@partner->getInfoFooterHead()}}" placeholder="heading">
                </div>
                <div class="form-group paragraph">
                    <label for="info-footer-body">Paragraph Text:</label>
                    <textarea rows="8" type="text" class="form-control" id="info-footer-body" name="info-footer-body" placeholder="paragraph text">{{@partner->getInfoFooterBody()}}</textarea>
                </div>
                <div class="form-group paragraph">
                    <label for="footer-head">Heading:</label>
                    <input type="text" class="form-control" id="footer-head" name="footer-head" value="{{@partner->getFooterHead()}}" placeholder="heading">
                </div>
                <div class="form-group paragraph">
                    <label for="footer-body">Paragraph Text:</label>
                    <textarea rows="8" type="text" class="form-control" id="footer-body" name="footer-body" placeholder="paragraph text">{{@partner->getFooterBody()}}</textarea>
                </div>
                <div class="form-group contact">
                    <label for="contact-name">Contact Name:</label>
                    <input type="text" class="form-control" id="contact-name" name="contact-name" value="{{@contact_name}}" placeholder="contact's full name">
                </div>
                <div class="form-group contact">
                    <label for="contact-title">Contact Title:</label>
                    <input type="text" class="form-control" id="contact-title" name="contact-title" value="{{@contact_title}}" placeholder="contact's title">
                </div>
                <div class="form-group contact">
                    <label for="contact-desc">Contact Description:</label>
                    <input type="text" class="form-control" id="contact-desc" name="contact-desc" value="{{@contact_desc}}" placeholder="contact's information">
                </div>
                <div class="form-group contact">
                    <label for="contact-phone">Contact Phone:</label>
                    <input type="text" class="form-control" id="contact-phone" name="contact-phone" value="{{@contact_phone}}" placeholder="(000) 000-0000">
                </div>
                <div class="form-group">
                    <label for="contact-email">Contact Email:</label>
                    <input type="email" class="form-control" id="contact-email" name="contact-email" value="{{@contact_email}}" placeholder="email@domain.com">
                </div>
                <div class="form-group img">
                    <label for="link">Link Path:<br>Include (http://) for external links</label>
                    <input type="text" class="form-control" id="link" name="link" value="{{@partner->getLink()}}" placeholder="http://www.site.com">
                </div>
                <div class="form-group img">
                    <label for="link">Link Text:</label>
                    <input type="text" class="form-control" id="link-text" name="link-text" value="{{@partner->getLinkText()}}" placeholder="link text">
                </div>
                <div class="form-group img">
                    <label for="usr-file-upload">Upload Partner Image:</label>
                    <input type="file" class="form-control" id="usr-file-upload" name="usr-file-upload">
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
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

<!-- Example Modal -->
<div class="modal fade bd-example-modal-lg" id="partner-example" tabindex="-1" role="dialog" aria-labelledby="partner-example-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLongTitle">EXAMPLE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bg-info" style="padding: 20px;">
                                <h1>Example</h1>
                                <p>Displays for format purposes only, not all data is displayed. This is how the partner will look on the partners page.</p>
                            </div>
                            <h1>{{@partner->getTitle()}}</h1>
                            <h2 class="sub-title">{{@partner->getSubTitle()}}</h2>
                            <hr>
                            <h3>{{@partner->getDescHead()}}</h3>
                            <check if="{{@partner->getDescBody()}}">
                                <true>
                                    <p>{{substr(@partner->getDescBody(), 0, 100)}}...</p>
                                </true>
                            </check>
                            <check if="{{@partner->getDescListData() != null}}">
                                <true>
                                    <h4>{{@partner->getDescListHead()}}</h4>
                                    <ul>
                                        <repeat group="{{@partner->getDescListData()}}" value="{{@desc_list_item}}">
                                            <li>{{substr(@desc_list_item, 0, 40)}}...</li>
                                        </repeat>
                                    </ul>
                                </true>
                            </check>
                            <h3>{{@partner->getDescFooterHead()}}</h3>
                            <p>{{substr(@partner->getDescFooterBody(), 0, 50)}}</p>
                            <h4>{{@partner->getInfoHead()}}</h4>
                            <p>{{substr(@partner->getInfoBody(), 0, 100)}}</p>
                            <check if="{{@partner->getInfoListData() != null}}">
                                <true>
                                    <h4>{{@partner->getInfoListHead()}}</h4>
                                    <ul>
                                        <repeat group="{{@partner->getInfoListData()}}" value="{{@info_list_item}}">
                                            <li>{{substr(@info_list_item, 0, 40)}}...</li>
                                        </repeat>
                                    </ul>
                                </true>
                            </check>
                            <h3>{{@partner->getInfoFooterHead()}}</h3>
                            <check if="{{@partner->getInfoFooterBody()}}">
                                <true>
                                    <p>{{substr(@partner->getInfoFooterBody(), 0, 100)}}...</p>
                                </true>
                            </check>
                            <check if="{{@partner->getContacts() != null}}">
                                <true>
                                    <h2>Contact</h2>
                                    <repeat group="{{@partner->getContacts()}}" value="{{@contact}}">
                                        <check if="{{@contact->getContactName() != null}}">
                                            <true>
                                                <h3>{{@contact->getContactName()}}</h3>
                                            </true>
                                        </check>
                                        <check if="{{@contact->getContactTitle() != null}}">
                                            <true>
                                                <h4>{{@contact->getContactTitle()}}</h4>
                                            </true>
                                        </check>
                                        <check if="{{@contact->getContactDesc() != null}}">
                                            <true>
                                                <p>{{@contact->getContactDesc()}}</p>
                                            </true>
                                        </check>
                                        <check if="{{@contact->getContactPhone() != null}}">
                                            <true>
                                                <p>Phone: <a href="tel:{{str_replace(@contact->getContactPhone(), '', @char_remove)}}">{{@contact->getContactPhone()}}</a></p>
                                            </true>
                                        </check>
                                        <check if="{{@contact->getContactEmail() != null}}">
                                            <true>
                                                <p>Email: <a href="mailto:{{@contact->getContactEmail()}}">{{@contact->getContactEmail()}}</a></p>
                                            </true>
                                        </check>
                                    </repeat>
                                </true>
                            </check>
                            <check if="{{@partner->getLink()}}">
                                <true>
                                    <a href="{{@partner->getLink()}}" class="btn btn-info">{{@partner->getLinkText()}}</a>
                                </true>
                            </check>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>