<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="post" action="{{ route('upload.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="my_file" />
        <button type="submit">送出</button>
    </form>
</body>

</html>
