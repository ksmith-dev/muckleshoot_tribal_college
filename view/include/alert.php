<check if="{{sizeof(@alert) > 0}} && {{@alert}} != NULL && {{@alert}} != ''">
    <true>
        <div class="alert alert-danger" role="alert">
            <h3>Alert!</h3>
            <h4>{{@alert->getAlertName()}}</h4>
            <p>{{@alert->getAlertMessage()}}<br><br></p>
            <p>Thank you,<br>-Staff</p>
        </div>
    </true>
    <false></false>
</check>
<!--
<div class="alert alert-success" role="alert">
    <h3>Success</h3>
    <p>All classes have returned to normal operation schedule. If you have having any difficulty get to class, please notify your instructor as soon as possible.<br><br>Thank you,<br>Signed - The Staff!</p>
</div>
<div class="alert alert-info" role="alert"></div>
<div class="alert alert-warning" role="alert"></div>
-->