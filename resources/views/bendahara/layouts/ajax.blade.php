<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button value="hello word" onclick="kirimnilai()" id="btn">tombol</button>
    <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <script>
        function kirimnilai() {
                console.log('hello');
            nilai = $('#btn').val();

            var data = "data1=haloo&data2=bujang";
            $.ajax({
                type: "post",
                url: "/kirimpesan",
                data: data,
                dataType: "text",
                success: function(kiriman) {
                    console.log(kiriman);
                }
            });

        }
    </script>
</body>

</html>