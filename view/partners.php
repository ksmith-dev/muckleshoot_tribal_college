<div id="partners-wrapper" class="container-fluid">
    <repeat group="{{@partners}}" value="{{@partner}}">
        <div class="row partner-wrapper">
            <div class="col-xs-12">
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <check if="{{@partner->getTitle()}}">
                            <true>
                                <h1>{{@partner->getTitle()}}</h1>
                            </true>
                        </check>
                        <check if="{{@partner->getSubTitle()}}">
                            <true>
                                <h2 class="sub-title"><i>{{@partner->getSubTitle()}}</i></h2>
                            </true>
                        </check>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <check if="{{@partner->getDescHead()}}">
                            <true>
                                <h3>{{@partner->getDescHead()}}</h3>
                            </true>
                        </check>
                        <check if="{{@partner->getDescBody()}}">
                            <true>
                                <p>{{@partner->getDescBody()}}</p>
                            </true>
                        </check>
                        <check if="{{@partner->getDescListData() != null}}">
                            <true>
                                <h4>{{@partner->getDescListHead()}}</h4>
                                <ul>
                                    <repeat group="{{@partner->getDescListData()}}" value="{{@list_item}}">
                                        <li>{{@list_item}}</li>
                                    </repeat>
                                </ul>
                            </true>
                        </check>
                        <check if="{{@partner->getDescFooterHead() != null}}">
                            <true>
                                <h3>{{@partner->getDescFooterHead()}}</h3>
                            </true>
                        </check>
                        <check if="{{@partner->getDescFooterBody() != null}}">
                            <true>
                                <p>{{@partner->getDescFooterBody()}}</p>
                            </true>
                        </check>
                        <check if="{{@partner->getInfoHead() != null}}">
                            <true>
                                <h3>{{@partner->getInfoHead()}}</h3>
                            </true>
                        </check>
                        <check if="{{@partner->getInfoBody() != null}}">
                            <true>
                                <p>{{@partner->getInfoBody()}}</p>
                            </true>
                        </check>
                        <check if="{{@partner->getInfoListData() != null}}">
                            <true>
                                <h4><i>{{@partner->getInfoListHead()}}</i></h4>
                                <ul>
                                    <repeat group="{{@partner->getInfoListData()}}" value="{{@list_item}}">
                                        <li>{{@list_item}}</li>
                                    </repeat>
                                </ul>
                            </true>
                        </check>
                        <check if="{{@partner->getInfoFooterHead() != null}}">
                            <true>
                                <h3>{{@partner->getInfoFooterHead()}}</h3>
                            </true>
                        </check>
                        <check if="{{@partner->getInfoFooterBody() != null}}">
                            <true>
                                <p>{{@partner->getInfoFooterBody()}}</p>
                            </true>
                        </check>
                        <check if="{{@partner->getFooterHead() != null}}">
                            <true>
                                <h3>{{@partner->getFooterHead()}}</h3>
                            </true>
                        </check>
                        <check if="{{@partner->getFooterBody() != null}}">
                            <true>
                                <p>{{@partner->getFooterBody()}}</p>
                            </true>
                        </check>
                        <check if="{{@partner->getFooterListData() != null}}">
                            <true>
                                <h4><i>{{@partner->getFooterListHead()}}</i></h4>
                                <ul>
                                    <repeat group="{{@partner->getFooterListData()}}" value="{{@list_item}}">
                                        <li>{{@list_item}}</li>
                                    </repeat>
                                </ul>
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
                        <check if="{{@partner->getLink() != null}}">
                            <true>
                                <a href="{{@partner->getLink()}}" class="btn btn-primary" role="button">{{$partner->getLinkText()}}</a>
                            </true>
                        </check>
                    </div>
                    <div class="hidden-sm col-md-4">
                        <check if="{{@partner->getImgPath() != null}}">
                            <true>
                                <img src="{{@partner->getImgPath()}}" style="margin-top: 40px; display: block; margin: 0 auto;" class="img-responsive">
                            </true>
                        </check>
                    </div>
                </div>
            </div>
        </div>
    </repeat>
    <div class="spacer-lg"></div>
</div>