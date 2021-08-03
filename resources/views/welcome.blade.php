<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>upload</title>
</head>
<body>


<form action="{{route('encryptFile')}}" method="post" enctype="multipart/form-data">

    <input type="hidden" name="_token" value="{{csrf_token()}}">

  <input type="file" name="file3" required="required">
  <button type="submit">Submit</button>
</form>
</body>
</html>
