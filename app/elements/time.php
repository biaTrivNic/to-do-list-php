<?php
date_default_timezone_set('America/Sao_Paulo');

$hora = date('H');

if ($hora >= 5 && $hora < 12) {
    $saudacao = 'Bom dia!';
} elseif ($hora >= 12 && $hora < 18) {
    $saudacao = 'Boa tarde!';
} else {
    $saudacao = 'Boa noite!';
}
?>
<section class="saudacao-container">
    <div class="saudacao-content">
        <div class="saudacao-text-container">
            <h1><?php echo $saudacao ?></h1>
            <p>Hoje é um ótimo dia para alcançar seus objetivos!</p>
        </div>
        <p><?php echo date('j \d\e M') ?></p>
    </div>
    <img src="/assets/img/ilustracao-de-planejamento.png" alt="">
</section>