<html>
<title>Admin Reset Password Page</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

<body class="container">
<h1>Client Reset Password</h1>


@if ($errors->any())
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
@endif


@if (Session::has('error'))
    <li>{{ Session::get('error') }}</li>
@endif
@if (Session::has('success'))
    <li>{{ Session::get('success') }}</li>
@endif



<form action="{{route('client.reset_password_submit')}}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Confirm New Password</label>
        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
