<!DOCTYPE html>
<html lang="en">
    <?php
    session_start(); 
    include_once "../common/connection.php";
    include_once "../common/funzioni.php";
    require "../common/header.php"
    ?>
    <body>
    <div><?php require "../common/navbar.php";?></div>
    <link href="../styles/statistics.css" rel="stylesheet">
    
   
        
    <section class="content">
    <h1>Admin Statistics:</h2>
        <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Users:</div>
                <div class="number"><?php $utenti = getUsers($cid); echo("".count($utenti));?></div>
               
            </div>
            </div>
            <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Photos:</div>
                <div class="number"><?php $foto = count(getPostsFoto($cid));  echo( $foto);?></div>
               
            </div>
            </div>
            <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Texts:</div>
                <div class="number"><?php $testo = count(getPostsTesto($cid));  echo( $testo);?></div>
               
            </div>
            </div>
        </div>
        <div class="sales-boxes">
            <div class="recent-sales box">
            <canvas id="grafico" width="600" height="400"></canvas>
            
        <?php 
            $utenti_graditi = array();
            foreach($utenti as $utente){ 
                $gradimenti_utente = getGradimenti($cid, $utente);
                foreach($gradimenti_utente as $gradimento_utente){
                    if ($gradimento_utente > 0)
                    array_push($utenti_graditi, $utente);
                }
            }
            

            ?> 
        

        <div class="box">
            <div class="right-side">
                <div class="info-utenti">
                <h1> Numero di Foto e Testi pubblicati dagli utenti: </h2>
            <?php foreach ($utenti as $utente)
                {$foto_utente = count(getCodiceFoto($cid, $utente)); 
                if ($foto_utente != 0){?>
                    <br> <?php echo "- ". (getNickname($cid, $utente) . " ha inserito " . $foto_utente ." foto"); 
                } else { ?>
                    <br> <?php echo "- ".(getNickname($cid, $utente) . " non ha inserito foto"); 
                }
                } 

            foreach ($utenti as $utente)
                {$testo_utente = count(getCodiceTesto($cid, $utente)); 
                    if ($testo_utente != 0){?>
                    <br> <?php echo "- ".(getNickname($cid, $utente) . " ha inserito " . $testo_utente ." testo"); 
                } else { ?>
                    <br> <?php echo ("- ".getNickname($cid, $utente) . " non ha inserito testi"); 
                } 
                } ?>
                </div>
                    </div>
                    </div>
                </div>

    </section>
   
    <script>
    let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        var categories = ["Roma", "Milano", "Napoli", "Torino", "Palermo"];
            var values = [200, 150, 120, 90, 75];
            var colors = ["red", "#33ff57", "#5733ff", "#ff33aa", "#33aaff"];

            // Funzione per disegnare il grafico a torta
            function drawCanvas(categories, values, colors) {
            var canvas = document.getElementById('grafico');
            var ctx = canvas.getContext('2d');

            // Pulisce il canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            var centerX = canvas.width / 2;
            var centerY = canvas.height / 2;
            var radius = Math.min(centerX, centerY) - 10;

            var total = values.reduce((acc, val) => acc + val, 0);
            var startAngle = 0;
            var endAngle = 0;

            // Disegna l'intestazione
            ctx.fillStyle = 'black';
            ctx.font = 'bold 16px Arial';
            ctx.fillText('Città più popolate', 5, 15);

            for (var i = 0; i < values.length; i++) {
                endAngle = startAngle + (values[i] / total) * (2 * Math.PI);

                ctx.beginPath();
                ctx.moveTo(centerX, centerY);
                ctx.arc(centerX, centerY, radius, startAngle, endAngle);
                ctx.closePath();
                ctx.fillStyle = colors[i];
                ctx.fill();

                // Calcola l'angolo centrale per posizionare il testo della percentuale
                var midAngle = (startAngle + endAngle) / 2;
                var textX = centerX + (radius / 2) * Math.cos(midAngle);
                var textY = centerY + (radius / 2) * Math.sin(midAngle);

                // Disegna la percentuale all'interno della fetta
                var percentage = (values[i] / total) * 100;
                ctx.fillStyle = 'black';
                ctx.font = 'bold 12px Arial';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle'; // Imposta l'allineamento verticale al centro
                ctx.fillText(percentage.toFixed(1) + '%', textX, textY);

                startAngle = endAngle;
            }

            // Disegna la legenda
            var legendX = 0;
            var legendY = 25;
            var legendSize = 15;
            var legendSpacing = 25;

            for (var i = 0; i < categories.length; i++) {
                ctx.fillStyle = colors[i];
                ctx.fillRect(legendX, legendY + i * legendSpacing, legendSize, legendSize);

                ctx.fillStyle = 'black';
                ctx.font = '14px Arial';
                ctx.textAlign = 'left'; // Imposta l'allineamento orizzontale a sinistra
                ctx.textBaseline = 'middle'; // Imposta l'allineamento verticale al centro
                ctx.fillText(categories[i], legendX + legendSize + 5, legendY + i * legendSpacing + legendSize / 2);
            }
            }

            // Disegna il grafico a torta iniziale all'avvio della pagina
            window.onload = function () {
            drawCanvas(categories, values, colors);
            };
    </script>
 
</body>
</html>

