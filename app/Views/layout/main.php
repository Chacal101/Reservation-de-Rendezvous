<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : "Dashboard - Gestion des Rendez-vous" ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/fr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
</head>
<body>

<!-- Loader avec fond bleu transparent et flou -->
<div id="loader-overlay" style="
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background: rgba(0, 123, 255, 0.4); /* Bleu transparent */
  backdrop-filter: blur(10px);        /* Flou */
  -webkit-backdrop-filter: blur(10px);
  z-index:9999;
  display:flex;
  flex-direction: column;
  justify-content:center;
  align-items:center;
  transition: opacity 0.5s ease;
">
  <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;">
    <span class="visually-hidden">Chargement...</span>
  </div>
  <p class="text-light mt-3">Chargement en cours...</p>
</div>

<!-- Sidebar -->
<?= view('layout/sidebar') ?>

<!-- Contenu Principal -->
<div class="content">
    <!-- Navbar -->
    <?= view('layout/header') ?>

    <!-- Section dynamique -->
    <?= $this->renderSection('content') ?>

    <div class="container mt-5">
        <!-- Footer ou autre contenu -->
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Custom JS -->
<script src="<?= base_url('assets/js/script.js') ?>"></script>

<!-- Script de masquage du loader -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
      const loader = document.getElementById('loader-overlay');
      loader.style.opacity = "0";
      setTimeout(() => loader.style.display = "none", 500);
    }, 3000);
  });
</script>

</body>
</html>
