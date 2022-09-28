 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/dashboard') ?>">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas far fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Admin</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="<?= base_url("admin/dashboard") ?>">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <?php if (session()->get('admin') == 'super_admin') : ?>
         <!-- Nav Item - Admin Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                 <i class="fas fa-fw fa-users"></i>
                 <span>Admin users</span>

             </a>
             <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="<?= base_url("admin/register") ?>">create Agent</a>
                     <a class="collapse-item" href="<?= base_url("admin/users/manage") ?>">Manage Agents</a>
                 </div>
             </div>
         </li>
         <!-- Divider -->
         <hr class="sidebar-divider d-none d-md-block">
     <?php endif; ?>

     <!-- Nav Item - Landlords Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
             <i class="fas fa-fw fa-users"></i>
             <span>Landlords</span>

         </a>
         <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="<?= base_url("admin/landlords/manage") ?>">View landlords</a>
                 <a class="collapse-item" href="<?= base_url("admin/landlord/add") ?>">Add landlord</a>
             </div>
         </div>
     </li>
     <!-- Nav Item - Tenants Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities10" aria-expanded="true" aria-controls="collapseUtilities10">
             <i class="fas fa-fw fa-users"></i>
             <span>Tenants</span>

         </a>
         <div id="collapseUtilities10" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="<?= base_url("admin/tenants/manage") ?>">Manage tenants</a>
                 <a class="collapse-item" href="<?= base_url("admin/tenants/add") ?>">Add tenants</a>
             </div>
         </div>
     </li>
     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">
     <!-- Nav Item - Tenants Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities3">
             <i class="fas fa-fw fa-users"></i>
             <span>Properties</span>

         </a>
         <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="<?= base_url("admin/property/manage") ?>">Manage properties</a>
                 <a class="collapse-item" href="<?= base_url("admin/property/add") ?>">Add properties</a>
             </div>
         </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

     <!-- Sidebar Message -->
     <div class="sidebar-card">
         <img class="sidebar-card-illustration mb-2" src="<?= base_url("assets/admin/img/undraw_rocket.svg") ?>" alt="">
         <?php if (getenv('CI_ENVIRONMENT') == 'development') : ?>
             <p class="text-center mb-2"><strong>Admin Dashboard</strong> is in development mode!</p>
         <?php else : ?>
             <p class="text-center mb-2"><strong>Admin Dashboard</strong> is now live!</p>
         <?php endif; ?>
     </div>

 </ul>