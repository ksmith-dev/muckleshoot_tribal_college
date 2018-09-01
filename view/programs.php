<div id="programs-wrapper" class="container-fluid">
    <repeat group="{{@programs}}" value="{{@program}}">
        <check if="{{@program->getActive() == 1}}">
            <div class="row program-wrapper">
                <div class="col-xs-12">
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <check if="{{@program->getTitle()}}">
                                <true>
                                    <h1>{{@program->getTitle()}}</h1>
                                </true>
                            </check>
                            <check if="{{@program->getSubTitle()}}">
                                <true>
                                    <h2 class="sub-title"><i>{{@program->getSubTitle()}}</i></h2>
                                </true>
                            </check>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-8">
                            <check if="{{@program->getDescHead()}}">
                                <true>
                                    <h3>{{@program->getDescHead()}}</h3>
                                </true>
                            </check>
                            <check if="{{@program->getDescBody()}}">
                                <true>
                                    <p>{{@program->getDescBody()}}</p>
                                </true>
                            </check>
                            <check if="{{@program->getDescListData() != null}}">
                                <true>
                                    <h4>{{@program->getDescListHead()}}</h4>
                                    <ul>
                                        <repeat group="{{@program->getDescListData()}}" value="{{@list_item}}">
                                            <li>{{@list_item}}</li>
                                        </repeat>
                                    </ul>
                                </true>
                            </check>
                            <check if="{{@program->getDescFooterHead() != null}}">
                                <true>
                                    <h3>{{@program->getDescFooterHead()}}</h3>
                                </true>
                            </check>
                            <check if="{{@program->getDescFooterBody() != null}}">
                                <true>
                                    <p>{{@program->getDescFooterBody()}}</p>
                                </true>
                            </check>
                            <check if="{{@program->getInfoHead() != null}}">
                                <true>
                                    <h3>{{@program->getInfoHead()}}</h3>
                                </true>
                            </check>
                            <check if="{{@program->getInfoBody() != null}}">
                                <true>
                                    <p>{{@program->getInfoBody()}}</p>
                                </true>
                            </check>
                            <check if="{{@program->getInfoListData() != null}}">
                                <true>
                                    <h4><i>{{@program->getInfoListHead()}}</i></h4>
                                    <ul>
                                        <repeat group="{{@program->getInfoListData()}}" value="{{@list_item}}">
                                            <li>{{@list_item}}</li>
                                        </repeat>
                                    </ul>
                                </true>
                            </check>
                            <check if="{{@program->getInfoFooterHead() != null}}">
                                <true>
                                    <h3>{{@program->getInfoFooterHead()}}</h3>
                                </true>
                            </check>
                            <check if="{{@program->getInfoFooterBody() != null}}">
                                <true>
                                    <p>{{@program->getInfoFooterBody()}}</p>
                                </true>
                            </check>
                            <check if="{{@program->getFooterHead() != null}}">
                                <true>
                                    <h3>{{@program->getFooterHead()}}</h3>
                                </true>
                            </check>
                            <check if="{{@program->getFooterBody() != null}}">
                                <true>
                                    <p>{{@program->getFooterBody()}}</p>
                                </true>
                            </check>
                            <check if="{{@program->getFooterListData() != null}}">
                                <true>
                                    <h4><i>{{@program->getFooterListHead()}}</i></h4>
                                    <ul>
                                        <repeat group="{{@program->getFooterListData()}}" value="{{@list_item}}">
                                            <li>{{@list_item}}</li>
                                        </repeat>
                                    </ul>
                                </true>
                            </check>

                            <check if="{{@program->getContacts() != null}}">
                                <true>
                                    <h2>Contact</h2>
                                    <repeat group="{{@program->getContacts()}}" value="{{@contact}}">
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
                            <check if="{{@program->getLink() != null}}">
                                <true>
                                    <a href="{{@program->getLink()}}" class="btn btn-primary" role="button">{{@program->getLinkText()}}</a>
                                </true>
                            </check>
                        </div>
                        <div class="hidden-xs col-sm-4">
                            <check if="{{@program->getImgPath() != null}}">
                                <true>
                                    <img src="{{@program->getImgPath()}}" style="margin-top: 40px; display: block; margin: 0 auto;" class="img-responsive">
                                </true>
                            </check>
                        </div>
                    </div>
                </div>
            </div>
        </check>
    </repeat>
    <div class="hidden-xs hidden-sm col-md-12">
        <hr>
        <h3 class="hidden-xs">FREQUENTLY ASKED QUESTIONS</h3>
        <h3 class="visible-xs hidden-sm hidden-md hidden-lg">FAQ</h3>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>QUESTIONS</th>
                    <th>ANSWERS</th>
                </tr>
                </thead>
                <tbody>
                <check if="{{@login}}  === true"> <!-- admin check -->
                    <true>
                        <form action="{{@BASE}}/update-faq-table" method="post">
                            <repeat group="{{@faq_array}}" value="{{@faq}}">
                                <tr>
                                    <td><textarea class="faq-text-area" name="faq-array[{{@faq['id']}}][question]" type="text">{{@faq['question']}}</textarea></td>
                                    <td><textarea class="faq-text-area" name="faq-array[{{@faq['id']}}][answer]" type="text">{{@faq['answer']}}</textarea></td>
                                </tr>
                            </repeat>
                            <input type="submit" class="btn btn-default" value="Update Table">
                        </form>
                    </true>
                    <false>
                        <repeat group="{{@faq_array}}" value="{{@faq}}">
                            <tr>
                                <td>{{@faq['question']}}</td>
                                <td>{{@faq['answer']}}</td>
                            </tr>
                        </repeat>
                    </false>
                </check>
                </tbody>
            </table>
        </div>
    </div>
    <div class="spacer-lg"></div>
</div>