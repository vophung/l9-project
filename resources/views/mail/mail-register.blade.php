Xin chào {{$email_data['name']}}
<br><br>
Welcome to my Website!
<br>
Please click the below link to verify your email and activate your account!
{{-- <br><br><a href="{{route('verify.code', $email_data['verification_code'])}}">Click Here!</a> --}}
<br><br><a href="http://localhost:8000/verify?code={{$email_data['verification_code']}}">Click Here!</a>
<br><br>
Thank You!
<br>
Phung Kool