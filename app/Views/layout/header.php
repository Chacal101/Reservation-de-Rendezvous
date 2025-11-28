<style>
    #hdr{
        padding-top: 3rem !important;
        background: linear-gradient(to bottom, #2c3e50, #1a2a3a);
    }
</style>
<body>
    <header class="admin-header">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg  shadow-sm p-3" id="hdr">
                <div class="container-fluid">
                    <!-- Logo/Brand (à ajouter si nécessaire) -->
                    <!-- <a class="navbar-brand" href="#">Admin</a> -->
                    
                    <!-- Bouton toggle pour mobile 
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>-->

                    <div class="collapse navbar-collapse" id="adminNavbar">
                        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between w-100">
                            <!-- Champ de recherche -->
                            <form method="get" action="<?=esc(base_url('admin/search'))?>" class="d-flex mb-3 mb-lg-0 me-lg-3 flex-grow-1">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control" placeholder="Rechercher..." required style="
    display: none;">
                                    <button type="submit" class="btn btn-primary" style="
    display: none;">
                                        <i class="fa-solid fa-search"></i>
                                    </button>
                                </div>
                            </form>

                            <!-- Actions droite -->
                            <div class="d-flex align-items-center">
                                <!-- Notification -->
                                <div class="notification-wrapper me-3">
                                    <?php
                                    $notificationModel = new \App\Models\NotificationModel();
                                    $nbNonLues = $notificationModel->where('statut', 'non lu')->countAllResults();
                                    ?>
                                    <a href="<?=esc(site_url('admin/notifications'))?>" class="btn btn-light position-relative border">
                                        <i class="fas fa-bell"></i>
                                        <?php if ($nbNonLues > 0): ?>
                                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">
                                                <?=esc($nbNonLues)?>
                                            </span>
                                        <?php endif; ?>
                                    </a>
                                </div>

                                <!-- Déconnexion -->
                                <form action="<?=base_url('admin/logout')?>" method="POST">
                                    <?=csrf_field()?>
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-sign-out-alt"></i> 
                                        <span class="d-none d-lg-inline">Déconnexion</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- CSS additionnel -->
        <style>
            .admin-header {
                position: sticky;
                top: 0;
                z-index: 1020;
            }
            
            .notification-wrapper .btn {
                transition: all 0.3s ease;
            }
            
            .notification-wrapper .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            
            @media (max-width: 991.98px) {
                #adminNavbar {
                    padding: 1rem;
                    background: white;
                    border-radius: 0.5rem;
                    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
                }
            }
        </style>
    </header>