@component('mail::message')
    <h1>Analysis Weekly Report</h1>
    <br>
    <p>Date export from {{ $data['start_date'] }} to {{ $data['end_date'] }}</p>
    <p>Please refer attachment below for more details</p>
    <p>This is an automation email, do not reply.</p>
    <br>
    <p>Thanks,</p>
    <p>Virtual Violations Detectors System</p>
@endcomponent