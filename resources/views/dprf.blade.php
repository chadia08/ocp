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
                        <h1 class="h3 mb-0 text-gray-800">DPRF</h1>
                    </div>
                    <div class="corp">
                                                
                        <table class="table">
                            <tr class="thead">
                                <th>Code_DPRF</th>
                                <th>code_article</th>
                                <th>code_famille</th>
                                <th>nom_famille</th>
                                <th>Qte_initiale</th>
                                <th>montant</th>
                                <th>date_sortie</th>
                                <th>état</th>
                                <th>action</th>
                            </tr>
                            @foreach($dprf as $dpr)
                                <tr>
                                    <td>{{$dpr->num_ot}}</td>
                                    <td>{{$dpr->code_article}}</td>
                                    <td>{{$dpr->code_famille}}</td>
                                    <td>{{$dpr->nom_famille}}</td>
                                    <td>{{$dpr->qte_sortie}}</td>
                                    <td>{{$dpr->qte_sortie*$dpr->pmp}}</td>
                                    <td>{{$dpr->date_sortie}}</td>
                                    <td>{{$dpr->statut}}</td>
                                    <!--boutton modal-->
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$dpr->code_article}}">
                                        Avancer état
                                    </button>
                                    </td> 
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="{{$dpr->code_article}}" tabindex="-1" aria-labelledby="exampleModalLabeln" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabeln">Passer Demande d'Achat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/PasserDa" method="post">
                                                    @csrf
                                                    <div class="d-flex justify-content-around">
                                                      <b>Accorde challenge:</b>
                                                      <label for="accorde_oui">Oui:</label>
                                                      <input name="challenge" id="accorde_oui" type="radio" value="oui" data-code-article="{{$dpr->code_article}}">
                                                      <label for="accorde_non">Non:</label>
                                                      <input name="challenge" id="accorde_non" type="radio" value="non" data-code-article="{{$dpr->code_article}}">
                                                    </div>

                                                    <br>
                                                    <div class="d-flex justify-content-around">
                                                      <b>Accorde budgétaire:</b>
                                                      <label for="budget_oui">Oui:</label>
                                                      <input name="budget" id="budget_oui" type="radio" value="oui" data-code-article="{{$dpr->code_article}}">
                                                      <label for="budget_non">Non:</label>
                                                      <input name="budget" id="budget_non" type="radio" value="non" data-code-article="{{$dpr->code_article}}">
                                                    </div>

                                                    <input type="hidden" name="id" value="{{$dpr->id_ot}}">
                                                    <input type="hidden" name="montant" value="{{$dpr->qte_sortie*$dpr->pmp}}">
                                                    <input type="hidden" name="article" value="{{$dpr->code_article}}">
                                                    <input type="hidden" name="qte" value="{{$dpr->qte_sortie}}">

                                                    <br>
                                                    <!-- Champ de saisie de texte à afficher -->
                                                    <div id="champ-texte-{{$dpr->code_article}}" style="display: none;">
                                                        <div  class="d-flex" >
                                                            <label  for="texte-{{$dpr->code_article}}"  class="mt-2 mb-2 ml-4 mr-4" style="font-weight : bold;">Numero de prévision:</label>
                                                            <input name="num_ot" id= "texte-{{$dpr->code_article}}"  type="text" class="form-control w-50">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-around">
                                                      <button type="button" class="btn btn-secondary w-25 m-4" data-bs-dismiss="modal">Fermer</button>
                                                      <input type="submit" class="btn btn-primary w-25 m-4" value="Enregistrer">
                                                    </div>
                                                  </form>
                                                  
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

<script>
    // Utilisez des sélecteurs d'éléments avec des attributs name et value
const accordeChallenges = document.querySelectorAll("[name='challenge'][value='oui']");
const accordeBudgets = document.querySelectorAll("[name='budget'][value='oui']");

// Parcourez tous les éléments correspondants et ajoutez des écouteurs d'événements à chacun
accordeChallenges.forEach(function(accordeChallenge) {
    accordeChallenge.addEventListener("change", afficherChampTexte);
});

accordeBudgets.forEach(function(accordeBudget) {
    accordeBudget.addEventListener("change", afficherChampTexte);
});

function afficherChampTexte() {
    // Utilisez des sélecteurs d'éléments avec des identifiants uniques pour chaque itération
    const codeArticle = this.getAttribute("data-code-article");
    const champTexte = document.querySelector("#champ-texte-" + codeArticle);

    // Utilisez des sélecteurs d'éléments avec des attributs name et value
    const accordeChallenge = document.querySelector("[name='challenge'][value='oui'][data-code-article='" + codeArticle + "']");
    const accordeBudget = document.querySelector("[name='budget'][value='oui'][data-code-article='" + codeArticle + "']");

    if (accordeChallenge.checked && accordeBudget.checked) {
        champTexte.style.display = "block"; 
    } else {
        champTexte.style.display = "none"; 
    }
}

</script>


</body>

</html>