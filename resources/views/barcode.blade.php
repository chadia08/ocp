<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>barcode</title>
</head>
<body>
    <table class="table m-1 mb-5" style="width:90%;">
        <tr class="table-secondary">
            <th>code_article</th>
            <th>descriptif</th>
            <th>categorie</th>
            <th>nature</th>
            <th>code à barre</th>
        </tr>
    @foreach($article as $art)
        <tr>
            <td>{{$art->code_article}}</td>
            <td>{{$art->descriptif}}</td>
            <td>{{$art->categorie}}</td>
            <td>{{$art->nature}}</td> 
            <td>
            @php
                $barcode = DNS1D::getBarcodeHTML($art->code_article, "C39");
                echo $barcode;
            @endphp
            </td>
            {{-- <td><img src="data:image/png;base64,{{ base64_encode(Barcode::generate('C128', $art->code_article)) }}" alt="Code à barres"></td>              --}}
        </tr>
    @endforeach
    </table>
</body>
</html>