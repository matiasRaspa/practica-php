<?php

const API_URL = "https://whenisthenextmcufilm.com/api";
#inicializar una nueva sesión de cURL; ch = cURL handle
$ch = curl_init(API_URL);
//Indicar que queremos recibir el resultado de la peticion y no mostrarla en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Problemas con el ssl, usar esto o configurar el cacert.pem:
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
/* Ejecutar la peticion
y guardamos el resultado */
$result = curl_exec($ch);
$data = json_decode($result, true);

//Otra alternativa si solo se necesita el get de una api es:
//$result = file_get_contents(API_URL);

#Cerramos conexion
curl_close($ch);

//Ver resultado
//var_dump($data);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La próxima pelicula de Marvel</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
</head>

<!-- <pre style="font-size: 15px; overflow: scroll; height: 250px;">
    <?php
    var_dump($data);
    ?>
</pre> -->

<main>
    <section>
        <img src="<?= $data["poster_url"]; ?>" width="300" alt="Poster de <?= $data["title"]; ?>"
            style="border-radius: 16px;" />
    </section>

    <hgroup>
        <h3><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> dias</h3>
        <p>Fecha de estreno: <?= $data["release_date"]; ?></p>
        <p>La siguiente es: <?= $data["following_production"]["title"]; ?></p>
    </hgroup>
</main>

<style>
    :root {
        color-scheme: light dark;
    }

    body {
        display: grid;
        place-content: center;
    }

    section {
        display: flex;
        justify-content: center;
        text-align: center;
    }

    hgroup {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    img {
        margin: 0 auto;
    }
</style>