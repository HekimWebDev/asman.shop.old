<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/lib/combo-tree/style.css') }}">
</head>
<body>

<input type="text" id="example" placeholder="Select">

<script src="{{ asset('admin/vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/lib/combo-tree/comboTreePlugin.js') }}"></script>

<script>
    var instance =  $('#example').comboTree({
        source: {{ \Illuminate\Support\Js::from($jsCat) }},
        isMultiple: true,
        collapse:true
    });
</script>

</body>
</html>
