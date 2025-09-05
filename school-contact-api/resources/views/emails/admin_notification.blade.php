@component('mail::message')
# New Contact Form Submission

**Name:** {{ $data['fullName'] }}  
**Email:** {{ $data['email'] }}  
**Mobile:** {{ $data['mobile'] ?? 'N/A' }}  
**Old Student:** {{ $data['isOldStudent'] ? 'Yes' : 'No' }}

**Message:**  
{{ $data['message'] }}

@endcomponent
