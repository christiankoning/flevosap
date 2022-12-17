<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['order_date']; ?></td>
    <td><?php echo $row['shipping_date']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td><?php echo $row['product']; ?></td>
    <td><?php echo $row['createdAt']; ?></td>
    <td><?php echo $row['updatedAt']; ?></td>

    <td>
        <form action="#" method="post">
            <input type="hidden" name="OrderId" value="<?= $row['id'] ?>">
            <button class="fa fa-pencil" type="submit" value="Bewerk order">
        </form>
                <form action="#" method="post">
                    <input type="hidden" name="OrderId" value="<?= $row['id'] ?>">
                    <button class="fa fa-trash" type="submit" value="Verwijderen order">
                </form>
    </td>

</tr>
