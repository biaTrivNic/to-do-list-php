<?php
date_default_timezone_set('America/Sao_Paulo');

$hora = date('H');

if ($hora >= 5 && $hora < 12) {
    $saudacao = 'Bom dia';
} elseif ($hora >= 12 && $hora < 18) {
    $saudacao = 'Boa tarde';
} else {
    $saudacao = 'Boa noite';
}

echo $saudacao;
?>
<section>
<div>
<h1><?php $saudacao ?></h1>
<?php echo date('j \d\e M') ?>
<p>Hoje é um ótimo dia para alcançar seus objetivos!</p>
</div>
<img src="/assets/img/ilustracao-de-planejamento.png" alt="">
</section>