<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <title>CARTA</title>
</head>
<body>

<div class="container">
    <center><h1>MENÚ</h1></center>
    <?php
    $menu = simplexml_load_file("./xml/carta.xml");
    if ($menu !== false) {
        $grouped_menu = [];
        foreach ($menu->children() as $plato) {
            $tipo = (string)$plato->nombre['tipo'];
            $grouped_menu[$tipo][] = $plato;
        }

        foreach ($grouped_menu as $tipo => $platos) {
            if ($tipo == "bebida") {
                echo "<h2>Bebidas</h2>";
            } else {
                echo "<h2>{$tipo}</h2>";
            }
            echo "<div class='row'>";
            foreach ($platos as $plato) {
                echo "<div class='col-md-4'>";
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$plato->nombre}</h5>";
                echo "<p class='card-text'>{$plato->descripcion}</p>";
                echo "<ul class='list-group list-group-flush'>";
                echo "<li class='list-group-item'>Precio: {$plato->precio} €</li>";
                echo "<li class='list-group-item'>Calorías: {$plato->calorias}</li>";
            
                if(isset($plato->ingredientes)) {
                    echo "<li class='list-group-item'>Ingredientes:";
                    foreach ($plato->ingredientes->categoria as $categoria) {
                        echo "<img src='{$categoria['enlace']}' alt='{$categoria}' class='ingredient-img'>";
                    }
                    echo "</li>";
                }
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        }
    } else {
        echo "Error al cargar el menu.";
    }
    ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
