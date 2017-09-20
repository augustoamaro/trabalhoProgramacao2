<?php

require_once './biblioteca.php';

startSession();
$paginas = obterPaginas();

$p = filter_input(INPUT_GET, 'p');
$codigoSelecionado = isset($paginas[$p]) ? $p : 'home';
$paginaSelecionada = isset($paginas[$codigoSelecionado]) ? $paginas[$codigoSelecionado] : $paginas['home'];

if($codigoSelecionado == "admin")
    verificaUsuarioLogado();

definirPaginaNavegada($codigoSelecionado);
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
      <?= $paginaSelecionada['titulo'] ?>
    </title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <link href="assets/css/justified-nav.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <div class="masthead">
        <h3 class="text-muted">Site da turma de sisnet</h3>
        <h5>Bem Vindo <?php echo obterUsuarioLogado() ?></h5>


        <nav class="navbar navbar-expand-md navbar-light bg-light rounded mb-3">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav text-md-center nav-justified w-100">


              <?php

foreach ($paginas as $codigo => $pagina) {
    if ($codigo == $codigoSelecionado) {
        
        $css = "active";
    } else {
        $css = "";
    }
    
    echo "<li class='nav-item  {$css}'><a class='nav-link' href='?p={$codigo}'>{$pagina['menu']}</a></li>";
}

?>
                
                
                <?php 
                    
                    if(isset($_SESSION[SESSION_LOGIN])) {
                ?>
                    <form action="logoff.php" method="POST">
                        <button type="submit" class="btn btn-danger">Logoff</button>
                    </form>
                    
                <?php } ?>
            </ul>
          </div>
        </nav>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <h2><?= $paginaSelecionada['titulo'] ?></h2>

          <?php

include($paginaSelecionada['conteudo'])

?>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; 2017 Alunos de Sisnet inc.</p>
      </footer>

    </div>
  </body>

  </html>