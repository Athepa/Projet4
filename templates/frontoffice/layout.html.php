<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>

    <body>
        <!-- Navigation -->
        <nav>
            <h2>Menu</h2>
            <a href="index.php?action=posts">Liste des posts</a><br>
            <a href="index.php?action=post&id=500">Un post qui n'existe pas</a><br>
            <a href="index.php?action=unknow">Une route qui n'existe pas</a><br>
        </nav>

        <!-- Page Header -->
        <header>
            <h1>Blog</h1>
        </header>

        <main>
            <?=$content?>
        </main>
        
        <footer class="footer text-center">
            <h3>Copyright Toto</h3>
        </footer>        
    </body>
</html>
