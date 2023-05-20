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

        /* Style du modal */
.modal {
  display: none; /* Cacher le modal par défaut */
  position: fixed; /* Positionnement absolu par rapport à la fenêtre */
  z-index: 1; /* Mettre le modal en avant-plan */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* Permettre le défilement si nécessaire */
  background-color: rgba(0, 0, 0, 0.874); /* Fond gris foncé semi-transparent */
}

/* Style du contenu du modal */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* Centrer le contenu */
  padding: 20px;
  border: 1px solid #888;
  width: 50%; /* Largeur du contenu */
}

/* Style de la croi de fermeture */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

/* Style des zones */
.zone {
  display: none; //Cacher les zones par défaut

}

.zone.active {
  display: block; /* Afficher la zone active */
}
.zonebtn{
    display: flex;
    justify-content: space-between;
}
.chose{
    width: 50%;
    height: 80px;

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
                        <h1 class="h3 mb-0 text-gray-800">Demande PDR</h1>
                    </div>
                    <!-------------------corps-------->
                    <div class="corp">
                        <!-- Button trigger modal -->  
        <!-------------------------------------------------------------------------------------------------------------------------------------------------->
                            <!-- Bouton déclencheur du modal -->
                        <button id="modal-button" class="btn btn-primary mybutton"><i class="fa fa-plus"></i> &nbsp;Ajouter PDR</button>
                        <br>
                        <br>
                        <!-- Modal -->
                        <div id="modal" class="modal" >
                            <div class="modal-content">
                                <span class="close" style="text-align: right;">&times;</span>
                                <h1>Demande PDR</h1>
                                <div class="zonebtn">
                                    <button id="zone1" class="chose btn btn-dark mr-1 ml-1 mb-5">Nouveau Article</button>
                                    <button id="zone2" class="chose btn btn-dark mr-1 ml-1 mb-5">Article Existant</button>
                                </div>
                                    <!----------------------------------- Nouveau Article -------------------------------------->
                                <div id="zone6" class="zone">
                                    <form method="post"  action="/pdr/CreerArticle">
                                        @csrf
                                        <input name="article" type="text" class="form-control mb-3" placeholder="Code Article">
                                        <input name="descriptif" type="text" class="form-control mb-3" placeholder="Descriptif">
                                        <input name="description" type="text" class="form-control mb-3" placeholder="Description">
                                        <input name="famille" type="text" class="form-control mb-3" placeholder="Famille">
                                        <input name="nature" type="text" class="form-control mb-3" placeholder="Nature">
                                        <input name="categorie" type="text" class="form-control mb-3" placeholder="Categorie">
                                        <input name="unite" type="text" class="form-control mb-3" placeholder="Unité">
                                        <input name="prix" type="text" class="form-control mb-3" placeholder="Prix Unitaire">
                                        <input name="qte" type="text" class="form-control mb-3" placeholder="Quantité">
                                        <input name="stock_min" type="text" class="form-control mb-3" placeholder="Stock min">
                                        <select name="service" class="form-select mb-3 " aria-label="Disabled select example">
                                            <option selected disabled hidden>Service</option>
                                            <option value="back log">Back Log</option>
                                            <option value="maintenance">Maintenance</option>
                                        </select> 
                                        <input name="personne" type="text" class="form-control mb-3" placeholder="Personne">
                                        <input name="installation" type="text" class="form-control mb-3" placeholder="Installation">
                                        <input name="justification" type="text" class="form-control mb-3" placeholder="Justification">
                                        <select name="statut" class="form-select mb-3 " aria-label="Disabled select example">
                                            <option selected disabled hidden>Statut</option>
                                                <option value="planifie">Planifie</option>
                                                <option value="curatif">Curatif</option>
                                        </select>

                                        <select name="criticite" class="form-select mb-3 " aria-label="Disabled select example">
                                            <option selected disabled hidden>Criticité</option>
                                                <option value="faible">Faible</option>
                                                <option value="moyenne">Moyenne</option>
                                                <option value="critique">Critique</option>
                                        </select>
                                        <input type="submit" class=" btn btn-primary  w-100" value="Valider">
                                    </form>
                                </div>

                                <!----------------------------------------- Article Existant------------------------------------>
                                <div  id="zone7" class="zone">
                                    <form method="post" action="/pdr/ArticleExistant">
                                        @csrf
                                        <input name="article" type="text" class="form-control mb-3" placeholder="Code Article">
                                        <input name="quantite" type="text" class="form-control mb-3" placeholder="Quantité">
                                        <select name="service" class="form-select mb-3 " aria-label="Disabled select example">
                                            <option selected disabled hidden>Service</option>
                                            <option value="back log">Back Log</option>
                                            <option value="maintenance">Maintenance</option>
                                        </select> 
                                        <input name="personne" type="text" class="form-control mb-3" placeholder="Personne">
                                        <input name="installation" type="text" class="form-control mb-3" placeholder="Installation">
                                        <input name="justification" type="text" class="form-control mb-3" placeholder="Justification">
                                        <select name="statut" class="form-select mb-3 " aria-label="Disabled select example">
                                            <option selected disabled hidden>Statut</option>
                                                <option value="planifie">Planifie</option>
                                                <option value="curatif">Curatif</option>
                                        </select>

                                        <select name="criticite" class="form-select mb-3 " aria-label="Disabled select example">
                                            <option selected disabled hidden>Criticité</option>
                                                <option value="faible">Faible</option>
                                                <option value="moyenne">Moyenne</option>
                                                <option value="critique">Critique</option>
                                        </select>
                                        <input type="submit" class="btn btn-primary w-100 " value="Valider">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-------------------------------------------------------------------------------------------------------------------------------------------------->
                    
                    <div style="overflow-x:scroll;">
                        <table class="table m-1 mb-5" style="width:100%;">
                            <tr>
                                <th colspan="2"></th>
                                <th colspan="2"></th>
                                <th colspan="2"></th>
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
                                <th>type</th>
                                <th>code_article</th>
                                <th>descriptif</th>
                                <th style="width:200px;">description</th>
                                <th>code_famille</th>
                                <th>unite</th>
                                <th>categorie</th>
                                <th>nature</th>
                                <th>qte_demandée</th>
                                <th>prix</th>
                                <th>prix_total</th>
                                <th>service</th>
                                <th>personne</th>
                                <th>installation</th>
                                <th>justification</th>
                                <th>date_sortie</th>
                                <th>Stock_Local</th>
                                <th>Stock_K0431</th>
                                <th>allouee</th>
                                <th>Taux_satisfaction</th>
                                <th>Distination</th>
                            </tr>
                            @foreach($pdrs as $pdr)
                            <tr>
                                <td>{{$pdr->type}}</td>
                                <td>{{$pdr->code_article}}</td>
                                <td>{{$pdr->descriptif}}</td>
                                <td>{{$pdr->description}}</td>
                                <td>{{$pdr->code_famille}}</td>
                                <td>{{$pdr->unite}}</td>
                                <td>{{$pdr->categorie}}</td>
                                <td>{{$pdr->nature}}</td>
                                <td>{{$pdr->qte_sortie}}</td>
                                <td>{{$pdr->pmp}}</td>
                                <td>{{$pdr->pmp*$pdr->qte_sortie}}</td>
                                <td>{{$pdr->service}}</td>
                                <td>{{$pdr->personne}}</td>
                                <td>{{$pdr->num_equipement}}</td>
                                <td>{{$pdr->justification}}</td>
                                <td>{{$pdr->date_sortie}}</td>
                                <td>{{$pdr->qte_allouee_local}}</td>
                                <td>{{$pdr->qte_allouee_fictif}}</td>
                                <td>{{$pdr->allouer}}</td>
                                @php
                                $satisfaction = (100*($pdr->qte_allouee_local+$pdr->qte_allouee_fictif))/$pdr->qte_sortie;
                                $taux = number_format($satisfaction,2);
                                @endphp
                                <td>{{$taux}} %</td>
                                @php
                                $destination=null;
                                    if($taux==100){
                                        $destination='en attente distribution';
                                    }elseif (1<=$taux && $taux<=99.99)  {
                                        $destination='en attente distribution / en attente approvisionnement';
                                    }else{
                                        $destination='en attente approvisionnement';
                                    }
                                @endphp
                                <td>{{$destination}}</td>
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
    </div>

   <script>
    // Récupération des éléments HTML
        var modal = document.getElementById("modal");
        var modalButton = document.getElementById("modal-button");
        var close = document.getElementsByClassName("close")[0];
        var zone1 = document.getElementById("zone1");
        var zone2 = document.getElementById("zone2");
        var division1 =document.getElementById("zone6");
        var division2 =document.getElementById("zone7");


        // Ajout de l'événement de clic sur le bouton déclencheur
        modalButton.onclick = function() {
        modal.style.display = "block"; // Afficher le modal
        zone1.classList.add("active"); // Afficher la zone 1 par défaut
        }

        // Ajout de l'événement de clic sur la croix de fermeture
        close.onclick = function() {
        modal.style.display = "none"; // Cacher le modal
        }

        // Ajout de l'événement de clic sur la zone 1
            zone1.onclick = function(event) {
                zone1.style.width = "100%";
                zone1.style.margin ="0";
                division1.style.display = "block";
                division1.style.textAlign = "center";
                event.stopPropagation(); 
                zone2.style.display = "none";
        }
        // Ajout de l'événement de clic sur la zone 2
            zone2.onclick = function() {
                zone2.style.width = "100%";
                zone2.style.margin ="0";
                division2.style.display = "block";
                division2.style.textAlign = "center";
                zone1.style.display = "none";
            }

   </script>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Chargement de bootstrap.bundle.min.js -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Chargement de jquery.easing.min.js -->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <!-- Chargement de sb-admin-min.js -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>