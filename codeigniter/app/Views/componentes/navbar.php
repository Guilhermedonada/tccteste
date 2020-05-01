<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Engenharia Elétrica Ulbra - Canoas</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<link rel="shortcut icon" type="image/png" href="<?=base_url("/assets/imagens/");?>/eletrica_logo.jpeg"/> 

	<link rel="stylesheet" type="text/css" href="<?=base_url("/assets/css/");?>/estilo.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous" />
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<?php use App\Models\LoginModel as Auth; ?>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Telemetria</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <?php if(Auth::verifica_sessao($redirect=false)): ?>
        <button class="btn btn-outline-success" type="button" onclick="realizar_medida()">Medir</button>
      <?php endif; ?>
        <ul class="navbar-nav ml-auto">
         
          <li class="nav-item">


               <?php if(Auth::verifica_sessao($redirect=false)): ?>
                  <a  class="nav-link" href="<?=site_url("Login/deslogar");?>">Sair</a>
                <?php else : ?>
                  <a class="nav-link" href="<?=site_url("Login/login_area");?>">Entrar</a>
                <?php endif; ?>

           
          </li>
        </ul>
      </div>
    </nav>
<body class="" style="overflow-x: hidden;margin-top: 0px;">