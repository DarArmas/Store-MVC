<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>GAMER-X</title>
        <link href="<?=base_url?>assets/css/styles.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div id="container"><!--CONTIENE TODA LA PAGINA-->
            <!--cabecera-->
            <header id="header">
                <div id="logo">
                    <a href="<?=base_url?>">
                            GAMER - X
                    </a> 
                </div>
            </header>


            <!-- menu -->
            <?php $categorias = Utils::showCategorias(); ?>
            <nav id="menu">

                <ul>
                    <li>
                        <a href="<?=base_url?> ">Inicio</a>
                    </li>

                   <?php while($cat = $categorias->fetch_object()): ?>
                    <li>
                        <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                    </li>
                    <?php endwhile; ?>
                    
                </ul>
            </nav>

            <!--barra lateral-->
            <div id="content">