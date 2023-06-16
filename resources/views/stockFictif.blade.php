<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=h, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <title>ocp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- <link href="style/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/min2.css') }}" rel="stylesheet">
    <style>
        body{
            
        }
        .img{
            width: 100%;
            height: 180px;
        }
        .fa{
            color: black;
        }
        
        .btn{
            float: left;
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
                        <h1 class="h3 mb-0 text-gray-800">Stock Fictif</h1>
                    </div>
                    <div class="corp">
                    <div style="overflow-x:scroll;">
                        <table class="table m-1 mb-5" style="width:100%;">
                        <tr class="thead">
                            <th>magasin</th>
                            <th>code_article</th>
                            <th>descriptif</th>
                            <th>description</th>
                            <th>code_famille</th>
                            <th>nom_famille</th>
                            <th>unite</th>
                            <th>categorie</th>
                            <th>nature</th>
                            <th>qte</th>
                            <th>prix</th>
                            <th>prix_total</th>
                            <th>date_entree</th>
                            <th>local</th>
                            <th>CessionHorsZone</th>
                            <th>CessionLocal</th>
                            
                        </tr>
                        
                        @php
                            $somme=0;
                        @endphp
                            @foreach($results as $result)
                            <tr>
                                <td>{{$result->nom_magasin}}</td>
                                <td>{{$result->code_article}}</td>
                                <td>{{$result->descriptif}}</td>
                                <td>{{$result->description}}</td>
                                <td>{{$result->code_famille}}</td>
                                <td>{{$result->nom_famille}}</td>
                                <td>{{$result->unite}}</td>
                                <td>{{$result->categorie}}</td>
                                <td>{{$result->nature}}</td>
                                <td>{{$result->qte}}</td>
                                <td>{{$result->pmp}}</td>
                                @php
                                    $somme += $result->pmp*$result->qte;  
                                @endphp
                                <td>{{$result->pmp*$result->qte}}</td>
                                <td>{{$result->date_entree}}</td>
                        
                                    <!-- Button trigger modal -->   
                                    @if(session('role')==='admin' || session('role')==='niveau2')
                                    <td class="d-flex"><button title="ajouter un article au magasin local par ot" type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#{{$result->code_article}}">
                                        <i class=" fa fa-arrow-circle-down"></i>
                                    </button>
                                    </td>
                                    @endif
                                    
                                    @if(session('role')==='admin' || session('role')==='niveau2')
                                    <td><button title="ajouter un article au cession hore zone par ot" type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#{{$result->descriptif}}">
                                        <i class=" fa fa-arrow-circle-up"></i>
                                    </button></td>
                                    @endif

                                    @if(session('role')==='admin' || session('role')==='niveau2')
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$result->code_article.$result->descriptif}}">
                                        <i class=" fa fa-arrow-circle-up"></i>
                                    </button>
                                    </td>
                                    @endif

                                    <!------------ Modal local ------------->
                                    <div class="modal fade" id="{{$result->code_article}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5 " id="exampleModalLabel">OT</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="/createOt" method="post">
                                                @csrf
                                                <label for="article">Code Article</label>
                                                <input  id="article" name="article" type="text" class="form-control  m-2" value="{{$result->code_article}}" readonly>
                                                <input name="ot" type="text" class="form-control m-2" placeholder="N° OT = 000000 ">
                                                <input name="description" type="text" class="form-control  m-2" placeholder="Description OT">
                                            
                                                <input  name="qte" type="text" class="form-control  m-2" placeholder="Quantité">
                                                <input  name="position" type="text" class="form-control  m-2" placeholder="Position">
                                                
                                                <select name="equipement" class="form-select w-5 m-2 " aria-label="Disabled select example" >
                                                    <option selected>Sélectionner l'equipement</option>
                                                    @foreach($equipement as $eqp)
                                                        <option value="{{$eqp->num_equipement}}">{{$eqp->num_equipement}}</option>
                                                    @endforeach
                                                </select>
                                                <select name="statut" class="form-select w-5 m-2 " aria-label="Disabled select example">
                                                    <option selected>Statut</option>
                                                        <option value="planifie">Planifie</option>
                                                        <option value="curatif">Curatif</option>
                                                        <option value="amelioration">Amelioration</option>
                                                </select>
                                            
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
                                            <input type="submit" class="btn btn-primary" value="Valider">
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                    </div>

                                    <!-- Modal Cession hors zone -->
                                    <div class="modal fade" id="{{$result->descriptif}}" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5 " id="exampleModalLabel1">Cession Hors Zone</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="/CessionHorsZone" method="post">
                                                @csrf
                                                <label for="article">Code Article</label>
                                                <input  id="article" name="article" type="text" class="form-control  m-2" value="{{$result->code_article}}" readonly>
                                                <input name="ot" type="text" class="form-control m-2" placeholder="N° Cession = 000000 ">
                                                <input name="description" type="text" class="form-control  m-2" placeholder="Description Cession">
                                            
                                                <input  name="qte" type="text" class="form-control  m-2" placeholder="Quantité">
                                                <input  name="demandeur" type="text" class="form-control  m-2" placeholder="Demandeur">
                                                <input  name="service" type="text" class="form-control  m-2" placeholder="Service">

                                                <select name="DestinationHorsZone" class="form-select w-5 m-2 " aria-label="Disabled select example">
                                                    <option selected>Destination Hors Zone</option>
                                                        <option value="eljadida">EL JADIDA</option>
                                                        <option value="benguerir">BENGUERIR</option>
                                                        <option value="laayoune">LAAYOUNE</option>
                                                        <option value="asafi">ASAFI</option>
                                                        <option value="casablanca">CASABLANCA</option>
                                                </select>            
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
                                            <input type="submit" class="btn btn-primary" value="Valider">
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                    </div>

                                    <!----------- Modal Cession Local ------------->
                                    <div class="modal fade" id="{{$result->code_article.$result->descriptif}}" tabindex="-1" aria-labelledby="exampleModalLabeln" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabeln">OT De Cession Local</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="/FictifCessionLocal" method="post">
                                                @csrf
                                                <input name="ot" type="text" class="form-control m-2" placeholder="N° Cession = 000000 ">
                                                <input name="article" type="text" class="form-control  m-2"  value="{{$result->code_article}}" readonly>
                                                <input name="description" type="text" class="form-control  m-2" placeholder="Justification">
                                            
                                                <input  name="qte" type="text" class="form-control  m-2" placeholder="Quantité">
                                                <input  name="demandeur" type="text" class="form-control  m-2" placeholder="Demandeur">
                                                <input  name="service" type="text" class="form-control  m-2" placeholder="Service">

                                                <select name="DestinationZoneLocal" class="form-select w-5 m-2 " aria-label="Disabled select example">
                                                    <option selected>Destination</option>
                                                        <option value="beni amir">Beni Amir</option>
                                                        <option value="beni idir">Beni Idir</option>
                                                </select>        
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <input type="submit" class="btn btn-primary" vlaue="Save changes">
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                    </div>
                        
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
                                <td>@php echo $somme; @endphp</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        
                    </table> 
                </div>

    @include('footer')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
   
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Chargement de bootstrap.bundle.min.js -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Chargement de jquery.easing.min.js -->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <!-- Chargement de sb-admin-2.min.js -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>