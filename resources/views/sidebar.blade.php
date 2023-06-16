<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
            <img src="{{ asset('logo.png')}}" style="height: 45px; width:70; ">
        </div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de Bord</span></a>
    </li>

    @if(session('role')==='admin' || session('role')==='niveau2')
    <li class="nav-item ">
        <a class="nav-link" href="/ot">
            <i class="fas fa-fw fa-star"></i>
            <span>OT</span></a>
    </li>
    @endif

    <li class="nav-item ">
        <a class="nav-link" href="/articles">
            <i class="fas fa-fw fa-star"></i>
            <span>Articles</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-book"></i>
            <span>Stock</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Magasin:</h6>
                <a class="collapse-item" href="/stock/local">local</a>
                <a class="collapse-item" href="/stock/fictif">fictif(K0431)</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Utilities Collapse Menu -->
    @if(session('role')==='admin' || session('role')==='niveau2')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-user"></i>
            <span>Utilisateurs</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Utilisateurs</h6>
                <a class="collapse-item" href="/users">afficher la liste</a>
                @if(session('role')==='admin')
                    <a class="collapse-item" href="/users/CreateUser">créer utilisateur</a>
                @endif
            </div>
        </div>
    </li>
    @endif
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cessions</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                
                {{-- <a class="collapse-item" href="/cessions">Cessions Local</a>
                <a class="collapse-item" href="/cessions">Cession Hors Zone</a> --}}
            </div>
        </div>
    </li>

    @if(session('role')==='admin' || session('role')==='niveau2')
    <li class="nav-item ">
        <a class="nav-link" href="/da">
            <i class="fas fa-fw fa-folder"></i>
            <span>Demandes d'Achat</span></a>
    </li>
    @endif
    
    @if(session('role')==='admin' || session('role')==='niveau2')
    <li class="nav-item ">
        <a class="nav-link" href="/dprf">
            <i class="fas fa-fw fa-folder"></i>
            <span>DPRF</span></a>
    </li>
    @endif

    @if(session('role')==='admin' || session('role')==='niveau2')
    <li class="nav-item ">
        <a class="nav-link" href="/pdr">
            <i class="fas fa-fw fa-folder"></i>
            <span>PDR</span></a>
    </li>
    @endif

    <li class="nav-item ">
        <a class="nav-link" href="/consommation">
            <i class="fas fa-fw fa-folder"></i>
            <span>Consommation</span></a>
    </li>

    @if(session('role')==='admin' || session('role')==='niveau2')
    <li class="nav-item ">
        <a class="nav-link" href="/AttenteApprovisionnement">
            <i class="fas fa-fw fa-folder"></i>
            <span>Attente Approvisionnement</span></a>
    </li>
    @endif

    @if(session('role')==='admin' || session('role')==='niveau2')
    <li class="nav-item ">
        <a class="nav-link" href="/commande">
            <i class="fas fa-fw fa-folder"></i>
            <span>Commandes</span></a>
    </li>
    @endif
    
    
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    </ul>
    <!-- End of Sidebar -->