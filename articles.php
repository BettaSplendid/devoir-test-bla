<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Le blogroquet - Connexion</title>
    <meta name="description" content="Ce site ne sert pas à grand chose. C'est une #perte de te mps. Franchement, vous avez mieux à faire.">
    </meta>
    <meta property="og:image" content="https://thumbs.dreamstime.com/z/parrot-sits-branch-bright-silhouette-drawn-various-lines-style-minimalism-tattoo-bird-logo-parrot-sits-174762319.jpg">
    <meta property="og:title" content="Parrot Homework Network">

    <link rel="shortcut icon" href="659d15e99fed5c1fdb7923de68673c79.png" type="image/x-icon">
    <link rel="stylesheet" href="mystyle.css">

    <script src="https://cdn.tiny.cloud/1/67l8eg596qjlctom7d5l1fwf5b41hsp50qi8p1fru6fts7nz/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
        });
    </script>

</head>

<body class="the_container">
    <div class="index_background">
        <div class="bar_bar">
            <a href="contact.php">Contact</a>
            <a href="comptes.php">Comptes</a>
            <a href="https://cultofthepartyparrot.com/">News</a>
            <a href="articles.php">Articles</a>
            <a class="active" href="index.php">Accueil</a>
        </div>

        <div class="parrot_background">
            <img class="fit_picture_index" src="exotic parrot cropped.png" width=30%>
        </div>

        <details>
            <summary>Latest articles</summary>
            <div class="articles_display">
                <?php
                include 'articles_functions.php';
                ?>
            </div>
        </details>

        <details>
            <summary>Insert form</summary>
            <div id="articles_insert_form">
                <form action="articles_functions.php" method="post">
                    <textarea name="mytextarea" id="mytextarea">Hello, World!</textarea>
                    <input class="form_stuff_submit" type="submit" value="Envoyer">
                </form>
            </div>
        </details>

    </div>
</body>

<footer class="the_footerman">
    <p><em> <small>@Mr Con Ure.</small></em></p>
</footer>