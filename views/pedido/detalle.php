<h1>DETALLE DEL PEDIDO</h1>

<?php if (isset($pedido)): ?>
    <?php if (isset($_SESSION['admin'])): ?>

        <h3>Cambiar estado del pedido</h3>

        <form action="<?= base_url ?>pedido/estado" method="POST">
            <input type="hidden" value="<?= $pedido->id ?>" name="pedido_id"/><!--PARA QUE EL id VIAJE EN EL POST JEJE-->
            <select name="estado">
                <option value="confirmed" <?= $pedido->estado == "confirmed" ? 'selected' : '' ?>>Pendiente</option>
                <option value="preparation" <?= $pedido->estado == "preparation" ? 'selected' : '' ?>>En preparacion</option>
                <option value="ready" <?= $pedido->estado == "ready" ? 'selected' : '' ?>>Preaprado para enviar</option>
                <option value="sent" <?= $pedido->estado == "sent" ? 'selected' : '' ?>>Enviado</option>
            </select>

            <input type="submit" value="Cambiar estado"/>
        </form>
        <br/>

    <?php endif; ?>

    <h3>Direccion de envio:</h3>


    Provincia: <?= $pedido->provincia ?><br/>
    Ciudad: <?= $pedido->localidad ?><br/>
    Direccion: <?= $pedido->direccion ?><br/><br/>

    <h3>Datos del pedido:</h3>

    Estado: <?= Utils::showStatus($pedido->estado) ?><br/>
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
    </table>
<?php endif; ?>
  