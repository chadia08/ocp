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
                        <h1 class="h3 mb-0 text-gray-800">Demande d'Achat</h1>
                    </div>
                    <div class="corp" style="overflow-x:scroll;">
                                                
                        <table class="table">
                            <tr class="thead">
                                <th>N°_prévision</th>
                                <th>code_famille</th>
                                <th>nom_famille</th>
                                <th>montant_initial</th>
                                <th>date_sortie</th>
                                <th>montant_challenge</th>
                                <th>N°_DA</th>
                                <th>N°_AO</th>
                                <th>date_AO</th>
                                <th>N°_AT</th>
                                <th>date_AT</th>
                                <th>N°_AC</th>
                                <th>date_AC</th>
                                <th class="mr-5 ml-5">phase</th>
                                <th>acheteur</th>
                                <th>action</th>
                            </tr>
                            @foreach($DA as $da)
                                <tr>
                                    <td>{{$da->num_ot}}</td>
                                    <td>{{$da->code_famille}}</td>
                                    <td>{{$da->nom_famille}}</td>
                                    <td>{{$da->taux}}</td>
                                    <td>{{$da->date_sortie}}</td>
                                    <td>{{$da->montant_challenge}}</td>
                                    <td>{{$da->num_da}}</td>
                                    <td>{{$da->num_ao}}</td>
                                    <td>{{$da->date_ao}}</td>
                                    <td>{{$da->num_at}}</td>
                                    <td>{{$da->date_at}}</td>
                                    <td>{{$da->num_ac}}</td>
                                    <td>{{$da->date_ac}}</td>
                             
                                    <td>{{$da->statut}}</td>
                                    <td></td>
                                    <td>
                                       
                                        <button type="button" class="btn  btn-primary m-1"  data-bs-toggle="modal" data-bs-target="#{{$da->id_ot}}">
                                            Avancer.DA
                                        </button>
                                        
                                    </td> 
                                    <!--Avancer DA-->
                                    <div class="modal fade" id="{{$da->id_ot}}" tabindex="-1" aria-labelledby="exampleModalLabeln" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabeln">Avancer La Demande d'Achat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/AvancerDa" method="post">
                                                    @csrf
                                                    <div id="champ-texte-{{$da->code_article}}" @if($da->statut == 'En attente DA' || $da->statut == 'En attente AO' || $da->statut == 'Avis technique' || $da->statut == 'En attente AC') style="display: block;" @else style="display: none;" @endif>
                                                        
                                                        @if($da->statut == 'En attente DA')
                                                            <label class=" mb-2 " style="font-weight : bold;">Numéro de Demande d'Achat</label>
                                                            <input name="num_da"  type="text" class="mb-3 form-control w-50" >
                                                            <label class=" mb-2 " style="font-weight : bold;">montant challenge</label>
                                                            <input name="montant_challenge"  type="text" class="mb-3 form-control w-50">
                                                        @elseif($da->statut == 'En attente AO')
                                                            <label class=" mb-2 " style="font-weight : bold;">Numéro d'Appel d'Offre</label>
                                                            <input name="num_ao" type="text" class="mb-3 form-control w-50" >
                                                        @elseif($da->statut == 'En attente AC')
                                                            <label class=" mb-2 " style="font-weight : bold;">Numéro d'Avis Commercial</label>
                                                            <input name="num_ac"  type="text" class="mb-3 form-control w-50"  >
                                                        @elseif($da->statut == 'Avis technique')
                                                            <label class=" mb-2 " style="font-weight : bold;">Numéro d'Avis Technique</label>
                                                            <input name="num_at"  type="text" class="mb-3 form-control w-50"  >
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="id" value="{{$da->id_ot}}">
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

    if (urlParams.has('cmd')) {
                    Swal.fire({
                icon: 'success',
                title: 'La Commande a été avancée',
                text: urlParams.get('cmd')
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