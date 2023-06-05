<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ocp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- <link href="style/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/min2.css') }}" rel="stylesheet">
    <style>
        .fa-trash{
            color: rgb(251, 47, 47);
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
                        <h1 class="h3 mb-0 text-gray-800">Attente Approvisionnement</h1>
                    </div>
                    <div class="corp">                     

                        <form method="post" action="/submitdprf">
                            @csrf
                            <select name="famille"  class="form-select mb-3 w-25 btn btn-primary" aria-label="Disabled select example">
                                <option selected disabled hidden>Famille</option>
                                    <option value="8UH">8UH</option>
                                    <option value="moyenne">Moyenne</option>
                                    <option value="critique">Critique</option>
                            </select>
                            <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
                        </form>
                        <div style="overflow-x:scroll;">
                            <table class="table m-1 mb-5" style="width:100%;">
                                <tr class="thead">
                                    <th>id</th>
                                    <th>code_famille</th>
                                    <th>nom_famille</th>
                                    <th>code_article</th>
                                    <th>descriptif</th>
                                    <th style="width:200px;">description</th>
                                    <th>prix_unitaire</th>
                                    <th>prix_total</th>
                                    <th>unite</th>
                                    <th>qte_demandée</th>
                                    <th>criticite</th>
                                    <th>date_sortie</th>
                                    <th>installation</th>
                                    <th>justification</th>
                                    <th style="text-align: center;">action</th>
                                    <th class="d-flex"><input type="checkbox" class="mr-2 ml-4"> Séléctionner_tout</th>
                                </tr>
                                @foreach($pdrs as $pdr)
                                <tr>
                                    <td>{{$pdr->id_ot}}</td>
                                    <td>{{$pdr->code_famille}}</td>
                                    <td>{{$pdr->nom_famille}}</td>
                                    <td>{{$pdr->code_article}}</td>
                                    <td>{{$pdr->descriptif}}</td>
                                    <td>{{$pdr->description}}</td>
                                    <td>{{$pdr->pmp}}</td>
                                    <td>{{$pdr->pmp*$pdr->qte_sortie}}</td>
                                    <td>{{$pdr->unite}}</td>
                                    <td>{{$pdr->qte_sortie}}</td>
                                    <td>{{$pdr->criticite}}</td>
                                    <td>{{$pdr->date_sortie}}</td>
                                    <td>{{$pdr->num_equipement}}</td>
                                    <td>{{$pdr->justification}}</td>
                                    <form action="/passerdprf" method="POST">
                                        @csrf
                                    <td class="d-flex">
                                    
                                        <a href="" class="btn btn-secondary m-2" style="width:160px;"> demander cession </a>
                                        <a href="" class="btn btn-danger  m-2" style="width:160px;"> modifier la qte </a>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="dprf"  valeur="{{$pdr->code_article}}" class="ml-4">
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary m-2" style="width:160px;">Passer DPRF</button>
                                    </td>
                                </tr>
                            </table>
                            
                        </form>
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
	  		title: 'User has been deleted successfully',
	  		text: urlParams.get('msg')
	});
}
    if (urlParams.has('error')) {
				 Swal.fire({
	  		icon: 'error',
	  		title: 'User has not been deleted ! try again',
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