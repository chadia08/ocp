<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <title>articles</title>
    <style>
        body{
            display: flex;
            justify-content: space-around;
        }
        .img{
            width: 100%;
            height: 180px;
        }
        .fa{
            color: black;
        }
        .btn:hover{
            background-color:gray;
            border-color: gray;
        }
        .btn{
            float: right;
        }
    </style>
</head>
<body>
    {{-- @foreach ($article as $art)
        <div class="card m-5" style="width: 18rem;">
            <img src='{{$art->image}}' class="card-img-top img" >
            <div class="card-body">
            <h5 class="card-title">{{$art->code_article}}</h5>
            <p class="card-text">Quantité: {{$art->descriptif}}<br>Some quick example text to build</p>
            <a href='/articles/{{$art->id}}' class="btn btn-warning">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </a>
            </div>
        </div>
    @endforeach --}}
    
    <table class="table m-5">
    <tr class="table-secondary">
        <th>code article</th>
        <th>descriptif</th>
        <th>nature</th>
        <th>catégorie</th>
    </tr>
    @foreach($article as $art)
        <tr>
            <td>{{$art->code_article}}</td>
            <td>{{$art->descriptif}}</td>
            <td>{{$art->categorie}}</td>
            <td>{{$art->nature}}</td>
            
        </tr>
    @endforeach
    </table>
</body>
</html>