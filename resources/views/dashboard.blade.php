<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>dashboard</title>
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
        a{
            text-decoration: none;
        }
        .progress-bar {
            background-color: green;
        }
        a{
            text-decoration: none;  
        }
    </style>

</head>

<body id="page-top">
@php
    session_start();
@endphp
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('sidebar')
        <!-- End of Sidebar -->
        {{-- <h1>
            
           @php
               dd(session()->all());
           @endphp
             --}}
        </h1>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
               @include('topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
                    </div>
                   

                     <!-- Content Row -->
                     <div class="row">

                        <!-- Users -->
                        <div class="col-xl-3 col-md-6 mb-4" >
                            <a href="/users">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Utilisateurs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users->count()}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>

                        <!-- Books -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="/ot">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                OT</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ot->count()}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>

                        <!-- list -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="/da">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Demandes d'Achat
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$progress->count()}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>

                        <!--  chi le3ba-->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="/commande">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Commandes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cmd->count()}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-between">
                        
                        @foreach($progress as $record)
                        <div class="col-xl-6 col-md-12 mb-4">
                            <div class="card shadow h-1000 ">
                                <div class="card-body">
                                    <h5 class="card-title text-gray-800"><i class="fas fa-fw fa-folder">&nbsp;</i>Demande d'Achat N° {{$record->num_da}}</h5>
                                    <h6 class="text-gray-800">Statut: {{$record->statut}}</h6>
                                        <div class="progress">
                                            <div class="progress-bar " role="progressbar" style="width: {{ $record->progress }}%">{{$record->progress }}%</div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>

                    <div class="row">

                        <!-- Bar Chart -->
                        <div class="col-xl-7 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header  -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Nombre d'Articles par Stock</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Doughnut Chart -->
                        <div class="col-xl-5 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header  -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Nombre d'Articles par Famille</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body p-5">
                                    <div class="chart-pie pt-1 pb-2">
                                        <canvas id="myChart2"></canvas>
                                    </div>
                                    
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chart =document.getElementById("myChart2");
        const data = {
                labels: ['8UH', 'a1b2c3', 'A1B', 'C1D'],
                datasets: [
                    {
                    label: 'Familles',
                    data: [30, 20, 15, 35],
                    backgroundColor: [
                        'green',
                        '#30353a',
                        '#9dd75e',
                        '#faf636'
                    ],
                    borderWidth: 1
                    }
                ]
                };
                // Options
                const options = {
                cutout: '50%',
                responsive: true,
                maintainAspectRatio: false
                };
        // Create chart instance
        new Chart(chart,  {
                type: 'doughnut',
                data: data,
                options: options
                });

        
    
        const chart2 =document.getElementById("myChart");
        // Data
        var stockLocal = {!! $stockLocal !!};
        var stockFictif = {!! $stockFictif !!};
        console.log(stockLocal);
        console.log(stockFictif);
        const data2 = {
        labels: [stockLocal[0].code_article, stockLocal[1].code_article, stockLocal[2].code_article, stockLocal[3].code_article, stockLocal[4].code_article],
        datasets: [
            {
                label: 'Stock Local',
                data: [stockLocal[0].qte, stockLocal[1].qte, stockLocal[2].qte, stockLocal[3].qte, stockLocal[4].qte],
                backgroundColor: '#9dd75e',
                borderWidth: 1,
                barPercentage: 0.4,
                categoryPercentage: 0.5
                },
                {
                label: 'Stock Fictif',
                data: [stockFictif[0].qte, stockFictif[1].qte, stockFictif[2].qte, stockFictif[3].qte, stockFictif[4].qte],
                backgroundColor: 'black',
                borderWidth: 1,
                barPercentage: 0.4,
                categoryPercentage: 0.5
            }
        ],
        borderWidth: 1
        };
        // Options
        const options2 = {
        scales: {
            y: {
            suggestedMin: 0,
            suggestedMax: 20,
            ticks: {
                stepSize: 2
            }
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        indexAxis: 'x',
        plugins: {
            legend: {
            position: 'top'
            }
        },
        layout: {
            padding: 10
        },
        barPercentage: 0.2,
        categoryPercentage: 0.8,
        borderRadius: 10
        };
        new Chart(chart2, { 
            type: 'bar',
            data: data2,
            options: options2
        });
        
        
        
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