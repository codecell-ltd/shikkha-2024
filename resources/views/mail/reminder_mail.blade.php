@component('mail::message')
# Hi 

 You Have a  Task Today  at {{$data['reminder_time']}}
Reminder Message: 

{{$data['reminder_message']}}
Task:
{{$data['task_name']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
