<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Engenharia Elétrica Ulbra - Canoas</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet"> 
  <link href="<?=base_url("/assets/css/");?>/bootstrap-datetimepicker.min.css" rel="stylesheet">
   <link href="<?=base_url("/assets/css/");?>/loader.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"      rel="stylesheet">

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg==" crossorigin="anonymous"></script>
  <script src="<?=base_url("/assets/js/");?>/bootstrap-datetimepicker.min.js"></script>
</head>
<?php use App\Models\LoginModel as Auth; ?>

<?php if(Auth::verifica_sessao($redirect=false)): ?>

<nav class="navbar navbar-expand-md navbar-dark fixed-top " style="background: #333333!important;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <?php if(Auth::verifica_sessao($redirect=false)): ?>
      <button class="btn btn-outline-success" type="button" id="js-realizar-medir" onclick="realizar_medida()">Realizar Medidas
      </button>
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

<?php else : ?>     
<nav class="navbar navbar-expand-md fixed-top ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav ml-auto">         
      <li class="nav-item">          
        <a class="nav-link text-white" href="<?=site_url("Login/login_area");?>">Entrar</a>          
      </li>
    </ul>
  </div>
</nav>
<?php endif; ?>

<body class="" style="overflow-x: hidden;margin-top: 0px;background: #333333!important;">