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
        .disable {
           border-color: white;
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
                        <h1 class="h3 mb-0 text-gray-800">Attente Approvisionnement</h1>
                    </div>
                    <div class="corp">                     

                        <form method="post" action="/submitdprf">
                            @csrf
                            <select name="famille"  class="form-select mb-3 w-25 btn btn-primary" aria-label="Disabled select example">
                                <option selected disabled hidden>Famille</option>
                                    <option value="8UH">8UH</option>
                                    <option value="moyenne">a1b2c3</option>
                                    
                            </select>
                            <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
                        </form>
                        <div style="overflow-x:scroll;">
                            <div class="d-flex" style="position: fixed; right: 0; margin-bottom: 100px; z-index: 9999;">
                                <select name="genre"  class="form-select m-2  btn btn-secondary" style="width:160px;" aria-label="Disabled select example">
                                    <option selected disabled hidden>Genre</option>
                                        <option value="electrique">éléctrique</option>
                                        <option value="instrument">instrument</option>
                                </select>
                                <button type="submit" class="btn btn-primary m-2" style="width:160px;">Passer DPRF</button>
                            </div>
                            <div>
                                
                            <table class="table m-1 mb-5 mt-5" style="width:100%;">
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
                                    
                                    <!--modification de la quantité-->
                                        <div class="modal fade" id="{{$pdr->id_ot}}" tabindex="-1" aria-labelledby="exampleModalLabeln" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabeln">Modifier la Quantité</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/modifierQte" method="post">
                                                        @csrf
                                                        Code Article:
                                                        <input name="article" type="text" class="form-control m-2" value="{{$pdr->code_article}}" readonly>
                                                        <input name="qte" type="text" class="form-control m-2" placeholder="Quantité">
                                                        <input name='id' type="hidden" value="{{$pdr->id_ot}}">
                                                        <button type="button" class="btn btn-secondary w-25 m-4" data-bs-dismiss="modal">Fermer</button>
                                                        <input type="submit" class="btn btn-primary w-25 m-4" value="Enregistrer">
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    
                                    <!--fin modification de la quantité-->

                                    
                                    <form action="/passerdprf" method="POST">
                                        @csrf
                                    <td class="d-flex">
                                    
                                        <button class="btn btn-secondary m-2" style="width:160px;" data-bs-toggle="modal" data-bs-target="#{{$pdr->id_ot.$pdr->code_article}}"> demander cession </a>
                                        <button type ="button" class="btn   m-2" style="width:160px; background-color:#faf636;" data-bs-toggle="modal" data-bs-target="#{{$pdr->id_ot}}">
                                        modifier la qte
                                        </button>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="checkboxes[]"  value="{{$pdr->id_ot}}" class="ml-4">
                                    </td>

                                    
                                </tr>
                                @endforeach
                            </div>
                                    
                                
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
	  		title: 'DPRF est passé avec ',
	  		text: urlParams.get('msg')
	});
}

if (urlParams.has('qte')) {
				 Swal.fire({
	  		icon: 'success',
	  		title: 'Quantité modifiée avec succès ',
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