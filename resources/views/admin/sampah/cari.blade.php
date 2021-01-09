<!-- @import url(''); -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu">

</head>
    
</body>
</html>
<style>
    body {
        font-family: 'Ubuntu', sans-serif;
        font-size: 16px;
    }

    .boxSearch {
        width: 100%;
        display: block;
        padding: 10px;
        border: 1px solid #0988A9;
    }

    ul.listSearch {
        padding-left: 0 !important;
    }

    .listSearch li {
        background-color: #0988A9;
        padding: 10px;
        margin: 5px 0;
        list-style: none;
        color: #DAD9DE;
    }

    .listSearch li:hover {
        background-color: #DAD9DE;
        color: #0988A9;
    }
</style>

<body>
    <input type="text" class="boxSearch" placeholder="Search..." />
    <ul class="listSearch">
        <li>Web Master</li>
        <li>Web Design</li>
        <li>Web Programming</li>
        <li>Graphic Design</li>
        <li>Digital Marketing</li>
        <li>Flash Animation</li>
    </ul>




    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function($) {

            $('.listSearch li').each(function() {
                $(this).attr('searchData', $(this).text().toLowerCase());
            });
            $('.boxSearch').on('keyup', function() {
                var dataList = $(this).val().toLowerCase();
                $('.listSearch li').each(function() {
                    if ($(this).filter('[searchData *= ' + dataList + ']').length > 0 || dataList.length < 1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

        });
    </script>

</body>