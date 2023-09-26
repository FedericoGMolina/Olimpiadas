<nav class="navbar navbar-expand-lg bg-body-tertiary" >
  <div class="container-fluid">

    <a class="navbar-brand" href="index.php">MHS</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php 
      if (isset($_SESSION['idRol'])){?>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php?view=ingreso">Ingreso</a>
        </li>
        <?php }?>
        <li class="nav-item">
        <a class="nav-link" href="index.php?view=pacientes">Tabla de Ingresos</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-disabled="true" href="index.php?view=reportes">Reportes</a>
        </li>
        <?php if (isset($_SESSION['idRol']) && ($_SESSION['idRol']==2)) 
        { ?>
         <li>
          <a class="nav-link" href="index.php?view=pAdmin">Admin Panel</a>
        </li>
        <?php 
      } ?>

    </ul>

    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    </div>

  </div>
</nav>

    