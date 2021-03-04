<!DOCTYPE html>
<html>
<head>
    <title>Velvet record back-office</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
 

<!-- Navbar -->
<div class="vertical-nav bg-white" id="sidebar">
  <div class="py-4 px-3 mb-4 bg-light">
    <div class="media d-flex align-items-center">
    
      <div class="media-body">
        <h4 class="m-0">Velvet Records</h4>
        <p class="font-weight-normal text-muted mb-0"></p>
      </div>
    </div>
  </div>


  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="#" class="nav-link text-dark bg-light">
                <i class="fa fa-home mr-3 text-primary fa-fw"></i>
                home
            </a>
    </li>
  </ul><br>
  <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Disques</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="views/disques_liste.php" class="nav-link text-dark bg-light">
                  <i class="fa fa-table mr-3 text-primary fa-fw"></i>
                  Voir tous les disques
              </a>
      </li>
      <li class="nav-item">
        <a href="views/disques_add_disque.php" class="nav-link text-dark">
                  <i class="fa fa-plus mr-3 text-primary fa-fw"></i>
                  Ajouter un disque
              </a>
      </li>
    </ul>
  <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Artistes</p>

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="views/artistes_liste.php" class="nav-link text-dark">
                <i class="fa fa-users mr-3 text-primary fa-fw"></i>
                Voir les artistes
            </a>
    </li>
    <li class="nav-item">
      <a href="views/artistes_add_form.php" class="nav-link text-dark">
                <i class="fa fa-plus mr-3 text-primary fa-fw"></i>
                Ajouter un artiste
            </a>
    </li>
  </ul>
</div>
<!-- Fin Navbar -->


<!-- Page content holder -->
<div class="page-content p-5" id="content">
  
</div>
<!-- End demo content -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="assets/js/app.js"></script>
</body>
</html>