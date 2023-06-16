<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ocp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- <link href="style/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/min2.css') }}" rel="stylesheet">
    <style>
        .fa-eye{
            color: rgb(255, 255, 255);
        }
        .mybutton{
            float: right;
            margin-bottom:5px; 
        }
        .thead{
            background-color: #2e3235;
            color: rgb(214, 206, 206);
        }
    </style>

</head>

<body id="page-top">
    
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
               @include('topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Articles</h1>
                    </div>
                    <div class="corp">
                        <div class="row  row-cols-lg-4  row-cols-md-2 row-cols-sm-1   mt-2">
                            @foreach($articles as $article)
                                <div class="col justify-content-space-around">
                                    <div class="card mt-3">
                                        <div>
                                            <img src="{{$article->image}}" class="card-img img-fluid" style="height:200px;" >
                                        </div>
                                        <div class="card-body">      
                                           
                                            <strong style='font-size: 1rem;'>{{$article->code_article}}</strong><br>
                                            <p><span  class='text-dark' style='font-size: 1rem;' >categorie: {{$article->categorie}}</span><br>
                                            <span  class="text-secondary" style='font-size: 1rem;' >famille: {{$article->code_famille}}</span>  </p>   
                                            
                                            <a class="btn btn-primary ml-5 " href="/articles/{{$article->id}}" style="float: right;"><i class="fa fa-eye"></i></a>
                                           						     
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- <table class="table">
                            <tr class="thead">
                                
                                <th>code_article</th>
                                <th>descriptif</th>
                                <th>code_famille</th>
                                <th>action</th>
                            </tr>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{$article->code_article}}</td>
                                    <td>{{$article->descriptif}}</td>
                                    <td>{{$article->code_famille}}</td>
                                    
                                    
                                    <td><a class="btn fa fa-eye" href="/articles/{{$article->id}}"></a></td>
                                    
                                </tr>
                            @endforeach
                        </table> --}}
                    </div>
                </div>
            </div>  

          
            @include('footer')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
   
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
	    if (urlParams.has('msg')) {
				 Swal.fire({
	  		icon: 'success',
	  		title: 'articler has been deleted successfully',
	  		text: urlParams.get('msg')
	});
}
    if (urlParams.has('error')) {
				 Swal.fire({
	  		icon: 'error',
	  		title: 'articler has not been deleted ! try again',
	  		text: urlParams.get('error')
	});
}
    </script>
    
  <script>
    const navAccueil = document.querySelector('.nav-link[href="blank.php"]');
    // Ajouter la classe "active" si la page actuelle correspond à la page "Accueil"
    if (window.location.href.includes('blank')) {
    navAccueil.classList.add('active');
}
  </script>
</body>

</html>