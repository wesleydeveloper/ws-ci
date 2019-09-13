<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $page_title ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/default/css/ws-ci-app.css') ?>">
</head>
<body class="auth">
<header>
    <h1>Login</h1>
</header>
<main class="main">
    <section class="content">
        <?= $view_content ?>
    </section>
</main>
<footer>
    <p>&copy; 2019<?= (date('Y') == '2019') ? '' : ' - '.date('Y')?> <?= $site_title ?>. Desenvolvido por <a href="https://wesleysilva.dev" target="_blank" class="btn btn-link">Wesley Silva.</a></p>
</footer>
<script src="<?= base_url('assets/default/js/ws-ci-app.js') ?>"></script>
</body>

</html>
