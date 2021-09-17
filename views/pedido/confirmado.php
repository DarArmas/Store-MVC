<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'Complete'): ?>
    <h1>Tu pedido se ha confirmado</h1>

    <p>Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria
        a la cuenta 737172381 con el coste del pedido, será procesado y enviado.
    </p>

    <?php if (isset($pedido)): ?>
        <h3>Datos del pedido:</h3>
        <!--<pre>: ME MANTIENE LOS SALTOS DE LINEA QUE ESCRIBA-->

        Numero de pedido: <?= $pedido->id ?><br/>
        Total a pagar: $<?= $pedido->coste ?><br/>
        
        <h3>Productos:</h3>

        <table>

            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>

            <!--RECUERDA QUE AQUI PRODUCTOS TIENE TODOS LOS PRODUCTOS QUE COINCIDAN CON MI ID DE PEDIDO-->
            <?php while ($producto = $productos->fetch_object()): ?>
                <tr>
                    <td>
                        <?php if ($producto->imagen != null): ?>
                            <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito"/>
                        <?php else: ?>
                            <img src="<?= base_url ?>/assets/img/camiseta.png" class="img_carrito"/>
                        <?php endif; ?>
                    </td>

                    <td>    
                        <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                    </td>

                    <td>    
                        <?= $producto->precio ?>
                    </td>

                    <td>
                        <!--LAS UNIDADES NO ESTÁ EN EL OBJETO PRODUCTO, SI NO EN EL ARRAY DEL CARRITO-->
                        <?= $producto->unidades ?>
                    </td>
                </tr>
            <?php endwhile ?>

        <?php endif; ?>
    </table>


<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'Complete') : ?>
    <h1>Tu pedido no ha podido procesarse</h1>

<?php endif; ?>
<!--PARA IMPLEMENTAR UN METODO DE PAGO SE UTILIZAN APIS Y LIBRERIAS-->
