<!DOCTYPE html>
<html lang="en">
<head>
    <title>Expedientes destruidos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Nombre</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($expedientes) / 54; $i++)
                @for ($j = 0; $j < 54; $j++)
                 <tr>
                     <td>{{ ($j*$i)+1 . ' ' . $expedientes[$j*$i]->full_name }}</td>
                     <td>{{ ($j*$i)+19 . ' ' . $expedientes[($j*$i)+18]->full_name }}</td>
                     <td>{{ ($j*$i)+37 . ' ' . $expedientes[($j*$i)+36]->full_name }}</td>
                </tr>

                @endfor

            @endfor
        </tbody>
    </table>
</body>
</html>
