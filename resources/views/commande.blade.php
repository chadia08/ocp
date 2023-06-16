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
            color: rgb(142, 251, 47);
        }
        .mybutton{
            float: right;
            margin-bottom:5px; 
        }
        .thead{
            background-color: #2e3235;
            color: rgb(214, 206, 206);
        }
        .modal-content{
            background-color: #2e3235;
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
                        <h1 class="h3 mb-0 text-gray-800">Les Commandes</h1>
                    </div>
                    <div class="corp" style="overflow-x:scroll;">
                                                
                        <table class="table">
                            <tr class="thead">
                                <th>code_article</th>
                                <th>code_famille</th>
                                <th>nom_famille</th>
                                <th>montant</th>
                                <th>Qte_initiale</th>
                                <th>date_sortie</th>
                                <th>fournisseur</th>
                                <th>stade</th>
                                <th>Qte_livrée</th>
                                <th>action</th>
                            </tr>
                            @foreach($commande as $cmd)
                                <tr>
                                    <td>{{$cmd->code_article}}</td>
                                    <td>{{$cmd->code_famille}}</td>
                                    <td>{{$cmd->nom_famille}}</td>
                                    <td>{{$cmd->taux}}</td>
                                    <td>{{$cmd->qte_sortie}}</td>
                                    <td>{{$cmd->date_sortie}}</td>
                                    <td>{{$cmd->fournisseur}}</td>
                                    <td>{{$cmd->stade}}</td>
                                    <td>{{$cmd->qte_livree}}</td>
                                    <td>
                                        <button type="button" class="btn  btn-primary m-1"  data-bs-toggle="modal" data-bs-target="#{{$cmd->id_ot}}">
                                            Avancer_Commande
                                        </button>
                                    </td> 
                                    
                                     <!--Avancer Commande-->
                                     <div class="modal fade" id="{{$cmd->id_ot}}" tabindex="-1" aria-labelledby="exampleModalLabeln" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabeln">Avancer La Commande</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/AvancerCommande" method="post">
                                                    @csrf
                                                    @if($cmd->fournisseur == null)
                                                        <label class=" mb-2 " style="font-weight : bold;">Fournisseur</label>
                                                        <input name="fournisseur" type="text" class="mb-3 form-control w-50">
                                                    @endif
                                                    <label class=" mb-2 " style="font-weight : bold;">Quantité Livrée</label>
                                                    <input type="text" name="qte_livree" class="mb-3 form-control w-50">
                                                    <input type="hidden" name="id" value="{{$cmd->id_ot}}">
                                                    <input type="submit" class="btn btn-primary" style="text-align:center;" value="Confirmer">
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </table>
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
	  		title: 'La Demande d\'Achat a été bien avancée',
	  		text: urlParams.get('msg')
	});
}
    if (urlParams.has('error')) {
				 Swal.fire({
	  		icon: 'error',
	  		title: 'La Demande d\'Achat n\'a pas été avancée',
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