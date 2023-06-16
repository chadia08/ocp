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
                        <h1 class="h3 mb-0 text-gray-800">Consommation</h1>
                    </div>
                    <div class="corp">                     
                        
                        <div style="overflow-x:scroll;">
                            <table class="table m-1 mb-5" style="width:100%;">
                                <tr>
                                    <th colspan="2"></th>
                                    <th colspan="2"></th>
                                    <th colspan="2"></th>
                                    <th colspan="2"></th>
                                    <th colspan="2"></th>
                                    <th colspan="2" style="text-align: center; background-color:#2e3235; color:rgb(214, 206, 206)">Qte_allouee</th>
                                    <th colspan="2"></th>
                                    <th></th>
                                </tr>
                                <tr class="thead">
                                    <th>id</th>
                                    <th>code_article</th>
                                    <th>descriptif</th>
                                    <th style="width:200px;">description</th>
                                    <th>unite</th>
                                    <th>qte_demandée</th>
                                    <th>service</th>
                                    <th>demandeurcca</th>
                                    <th>installation</th>
                                    <th>justification</th>
                                    <th>date_sortie</th>
                                    <th>Stock_Local</th>
                                    <th>Stock_K0431</th>
                                    <th>allouee</th>
                                    <th>Distribution</th>
                                    <th>N°OT</th>
                                    <th>Distribue</th>
                                    
                                </tr>
                                @foreach($pdrs as $pdr)
                                <tr>
                                    <td>{{$pdr->id_ot}}</td>
                                    <td>{{$pdr->code_article}}</td>
                                    <td>{{$pdr->descriptif}}</td>
                                    <td>{{$pdr->description}}</td>
                                    <td>{{$pdr->unite}}</td>
                                    <td>{{$pdr->qte_sortie}}</td>
                                    <td>{{$pdr->service}}</td>
                                    <td>{{$pdr->personne}}</td>
                                    <td>{{$pdr->num_equipement}}</td>
                                    <td>{{$pdr->justification}}</td>
                                    <td>{{$pdr->date_sortie}}</td>
                                    <td>{{$pdr->qte_allouee_local}}</td>
                                    <td>{{$pdr->qte_allouee_fictif}}</td>
                                    <td>{{$pdr->allouer}}</td>
                                    @php
                                        $bool = 'Non';
                                        if ($pdr->ot_local != null || $pdr->ot_fictif != null ) {
                                            $bool = 'Oui';                                            
                                        }
                                    @endphp
                                    <td>{{$bool}}</td>
                                    <td>Local:{{$pdr->ot_local}}<br> Fictif:{{$pdr->ot_fictif}}</td>
                                    @if(session('role')==='admin' || session('role')==='niveau2')
                                    <td>
                                        @php
                                            $a=1; $b=2; $c=3;
                                            $id = $pdr->id_ot;
                                        @endphp
                                        
                                            @if ( $pdr->qte_allouee_local != 0 && $pdr->qte_allouee_fictif == 0 )
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#{{$pdr->id_ot}}">
                                                    <i class=" fa fa-arrow-circle-down"></i>
                                                </button>
                                            @endif
                                            @if ( $pdr->qte_allouee_local == 0 && $pdr->qte_allouee_fictif != 0 )
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$pdr->id_ot.$b}}">
                                                    <i class=" fa fa-arrow-circle-down"></i>
                                                </button>
                                            @endif
                                            @if ( $pdr->qte_allouee_local != 0 && $pdr->qte_allouee_fictif != 0 )
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$pdr->id_ot.$c}}">
                                                    <i class=" fa fa-arrow-circle-down"></i>
                                                </button>
                                            @endif
                                    </td>
                                   

                                    <!----- Modal ot local ----->
                                    <div class="modal fade" id="{{$pdr->id_ot}}" tabindex="-1" aria-labelledby="exampleModalLabeln" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabeln">Valider Distribution</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/consommation/otLocal" method="post">
                                                    @csrf
                                                    <input name="ot_local" type="text" class="form-control m-2" placeholder="N° OT Local = 000000 ">
                                                    <input name="description_ot_local" type="text" class="form-control  m-2" placeholder="Description OT local">
                                                    <input name="article" type="text" class="form-control  m-2"  value="{{$pdr->code_article}}" >
                                                    <input name="id" type="hidden" class="form-control  m-2"  value="{{$pdr->id_ot}}" >
                                                    <input name="qte_allouee_local" type="hidden" class="form-control  m-2"  value="{{$pdr->qte_allouee_local}}" readonly>
                                                    <input name="qte_allouee_fictif" type="hidden" class="form-control  m-2"  value="{{$pdr->qte_allouee_fictif}}" readonly>
                                                    <input name="magasinier" type="text" class="form-control  m-2" placeholder="magasinier">      
                                            </div>  
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <input type="submit" class="btn btn-primary" value="Valider">
                                                    </div>
                                                </form>
                                        </div>
                                        </div>
                                    </div>

                                    <!-- Modal ot Fictif -->
                                    <div class="modal fade" id="{{$pdr->id_ot.$b}}" tabindex="-1" aria-labelledby="exampleModalLabeln" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabeln">Valider Distribution</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/consommation/otFictif" method="post">
                                                    @csrf
                                                    <input name="ot_fictif" type="text" class="form-control m-2" placeholder="N° OT Fictif = 000000 ">
                                                    <input name="description_ot_fictif" type="text" class="form-control  m-2" placeholder="Description OT local">
                                                    <input name="id" type="hidden" class="form-control  m-2"  value="{{$pdr->id_ot}}" >
                                                    <input name="article" type="text" class="form-control  m-2"  value="{{$pdr->code_article}}" >
                                                    <input name="qte_allouee_local" type="hidden" class="form-control  m-2"  value="{{$pdr->qte_allouee_local}}" readonly>
                                                    <input name="qte_allouee_fictif" type="hidden" class="form-control  m-2"  value="{{$pdr->qte_allouee_fictif}}" readonly>
                                                    <input  name="magasinier" type="text" class="form-control  m-2" placeholder="magasinier">      
                                            </div>  
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <input type="submit" class="btn btn-primary" value="Valider">
                                                    </div>
                                                </form>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Modal ot Fictif et Local -->
                                    <div class="modal fade" id="{{$pdr->id_ot.$c}}" tabindex="-1" aria-labelledby="exampleModalLabeln" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabeln">Valider Distribution</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/consommation/OtLocalFictif" method="post">
                                                    @csrf
                                                    <input name="ot_local" type="text" class="form-control m-2" placeholder="N° OT Local = 000000 ">
                                                    <input name="description_ot_local" type="text" class="form-control  m-2" placeholder="Description OT local">
                                                    <input name="ot_fictif" type="text" class="form-control m-2" placeholder="N° OT Fictif = 000000 ">
                                                    <input name="description_ot_fictif" type="text" class="form-control  m-2" placeholder="Description OT local">
                                                    <input name="id" type="hidden" class="form-control  m-2"  value="{{$pdr->id_ot}}" >
                                                    <input name="article" type="text" class="form-control  m-2"  value="{{$pdr->code_article}}" readonly>
                                                    <input name="qte_allouee_local" type="hidden" class="form-control  m-2"  value="{{$pdr->qte_allouee_local}}" readonly>
                                                    <input name="qte_allouee_fictif" type="hidden" class="form-control  m-2"  value="{{$pdr->qte_allouee_fictif}}" readonly>
                                                    <input  name="magasinier" type="text" class="form-control  m-2" placeholder="magasinier">      
                                            </div>  
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <input type="submit" class="btn btn-primary" value="Valider">
                                                    </div>
                                                </form>
                                        </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                </tr>
                                @endforeach
                            </table>
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