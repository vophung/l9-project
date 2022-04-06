Xin chào {{$data['email']}}
<br><br>
Welcome to my Website!
<br>
Please click the below link to reset your password!
<br><br><a href="{{$data['link']}}">Click Here!</a>
{{-- <br><br><a href="{{route('password.reset', ['token' => $data['token'], 'email' => $data['email']])}}">Click Here!</a> --}}
<br><br>
Thank You!
<br>
Phung Kool