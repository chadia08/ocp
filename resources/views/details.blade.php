<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>details</title>
   
</head>
<body>
    @foreach ($article as $art)
        @if ($art->id==$id)
            <div class="card" style="width: 18rem;">
                <img src='{{$art->image}}' class="card-img-top img" >
                <div class="card-body">
                <h5 class="card-title">{{$art->description}}</h5>
                <p class="card-text">Quantité: {{$art->descriptif}}<br>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        @endif
    @endforeach
</body>
</html>