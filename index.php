
<?php
define('WWW_RAIZ', dirname(__FILE__));
define('SP', DIRECTORY_SEPARATOR);
require_once (WWW_RAIZ . SP . 'autoload.php');

use libs\classes\Agenda;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Gaspar Teixeira <gaspar.teixeira@gmail.com>">
        <title>Agenda de Eventos</title>
        <link rel="stylesheet" href="resources/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="resources/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="resources/css/style.css" type="text/css" />
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">Calendário em PHP</h3>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?php
                    $agenda = new Agenda();
                    $data = isset($_GET['d']) ? $agenda->tempo($_GET['d']) : time();
                    echo $agenda->desenharCalendario($data);
                    ?>
                </div>

                <div class="col-lg-6">
                    <h2>Eventos:</h2>
                    <?php $eventos = $agenda->eventosNaData(isset($_GET['d']) ? $_GET['d'] : time()); ?>
                    <?php if(count($eventos)): ?>
                    <table class="table table-condensed table-striped">
                        <?php foreach ($eventos as $e): ?>
                            <tr>
                                <td class="right">Evento:</td>
                                <td class="left"><?php echo $e->getEvento() ?></td>
                            </tr>
                            <tr>
                                <td class="right">Data:</td>
                                <td class="left"><?php echo date('d/m/Y', strtotime($e->getData())) ?></td>
                            </tr>
                            <tr>
                                <td class="right">Local:</td>
                                <td class="left"><?php echo $e->getLocal() ?></td>
                            </tr>
                            <tr>
                                <td class="right">Descrição:</td>
                                <td class="left"><?php echo $e->getDescricao() ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="resources/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="resources/js/scripts.js"></script>
    </body>
</html>
