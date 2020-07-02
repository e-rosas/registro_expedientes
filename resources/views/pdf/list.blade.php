<!DOCTYPE html>
<html lang="en">
<head>
    <title>Expedientes destruidos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        body {
            font: 12px/1.4 "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <table class="center">
        <thead>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($list); $i++)
                <tr>
                    @for ($j = 0; $j < 3; $j++)
                        <td>{{ $list[$i][$j] }}</td>
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>
