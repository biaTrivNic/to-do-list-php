<?php $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$path = parse_url($url, PHP_URL_PATH);

$segments = explode('/', trim($path, '/'));

$content = end($segments);

?>

<aside class="menu_container">
    <h1 class="menu_title">Tarex</h1>
    <nav>
        <ul>
            <li class="<?php if ($content == 'home') echo 'active'?>"><a href="/">HOME</a></li>
            <li class="<?php if ($content == 'tarefas') echo 'active'?>"><a href="/tarefas">LISTA DE TAREFAS</a></li>
            <li class="<?php if ($content == 'kanban') echo 'active'?>"><a href="/tarefas/kanban">KANBAN</a></li>
        </ul>
    </nav>
</aside>