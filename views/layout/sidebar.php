 
<aside id="lateral">
    
    <div id="carrito" class="block_aside">
        <h3>Mi carrito</h3>
        <ul>
            <!--statsCarrito me regresa un array con el count de productos y monto total-->
            <?php $stats= Utils::statsCarrito();?>
            <li><a href="<?=base_url?>/carrito/index">Ver el carrito</a></li>
            <li><a href="<?=base_url?>/carrito/index">Productos: <?=$stats['count'] ?> </a></li>
            <li><a href="<?=base_url?>/carrito/index">Total: $<?= $stats['total']?></a></li>
        </ul>
        
        
        
    </div>
    
    
    <div id="login" class="block_aside">


        <?php if (!isset($_SESSION['identity'])): ?>
            <h3>Entrar a la web</h3>
            <form action="<?= base_url ?>usuario/login" method="post">
                <label for="email">Email</label>
                <input type="email" name="email"/>

                <label for="password">Contraseña</label>
                <input type="password" name="password"/>

                <input type="submit" value="Enviar" /> 
            </form>


        <?php else: ?>
            <h3>Bienvenido <?= $_SESSION['identity']->nombre ?> </h3>
        <?php endif; ?>
            
        <?php if(isset($_SESSION['error_login']) && $_SESSION['error_login'] == 'Identificacion fallida!!'):?> 
            <strong class="alert_red" style="margin-top: 20px;">Contraseña incorrecta, vuelva a intentar</strong>
            <?php Utils::deleteSession('error_login'); ?>
            <?php endif;?>
        <ul>

            <?php if (isset($_SESSION['admin'])): ?>
                <li><a href="<?= base_url ?>categoria/index">Gestionar categorias</a></li>
                <li><a href="<?=base_url ?>producto/gestion">Gestionar productos</a></li>
                <li><a href="<?=base_url ?>pedido/gestion">Gestionar pedidos</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['identity'])): ?>
                <li><a href="<?=base_url ?>pedido/mis_pedidos">Mis pedidos</a></li>
                <li><a href="<?= base_url ?>usuario/logout">Cerrar sesion</a></li>

            <?php else: ?>
                <li><a href="<?= base_url ?>usuario/registro">Registrate aqui</a></li>
            <?php endif; ?>

        </ul>
    </div>
</aside>

<!--contenido central-->
<div id="central"> 

