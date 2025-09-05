@component('mail::message')
# Hello {{ $data['fullName'] }},

Thank you for contacting us. We have received your message:

**Message:**  
{{ $data['message'] }}

We will get back to you shortly.

Thanks,<br>
admin JHCs
@endcomponent
