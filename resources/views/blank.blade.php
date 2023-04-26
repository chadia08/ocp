<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>blank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- <link href="style/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/min2.css') }}" rel="stylesheet">
    <style>
         .corp{
            margin: 20px;
        } 
        .fa-trash{
            color: red;
        }
        .mybutton{
            float: right;
            margin-bottom:5px; 
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
                        <h1 class="h3 mb-0 text-gray-800">page heading</h1>
                    </div>
                    <div class="corp">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mybutton" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-user-plus"></i> &nbsp;Ajouter Utilisateur
                        </button>                          
                        <table class="table">
                            <tr class="table-secondary">
                                <th>id</th>
                                <th>Matricule</th>
                                <th>nom</th>
                                <th>prenom</th>
                                <th>password</th>
                                <td>role</td>
                                <th>delete</th>
                            </tr>
                            @foreach($user as $use)
                                <tr>
                                    <td>{{$use->id}}</td>
                                    <td>{{$use->email}}</td>
                                    <td>{{$use->name}}</td>
                                    <td>{{$use->prenom}}</td>
                                    <td>{{$use->password}}</td>
                                    <td>{{$use->role}}</td>
                                    <td><i class="btn fa fa-trash"></i></td>
                                    
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>  

            <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">ajouter utilisateur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Matricule: <input type="text" name="matricule" class="form-control">
                            Nom: <input type="text" name="nom" class="form-control">
                            Prenom: <input type="text" name="prenom" class="form-control">
                            Mot de passe: <input type="password" name="password" class="form-control">
                            Role: <select class="form-select" aria-label="Default select example" class="form-control">
                                <option selected>role</option>
                                <option value="1">admin</option>
                                <option value="2">niveau2</option>
                                <option value="3">niveau3</option>
                              </select>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
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

    
  <script>
    const navAccueil = document.querySelector('.nav-link[href="blank.php"]');
    // Ajouter la classe "active" si la page actuelle correspond à la page "Accueil"
    if (window.location.href.includes('blank')) {
    navAccueil.classList.add('active');
}
  </script>
</body>

</html>