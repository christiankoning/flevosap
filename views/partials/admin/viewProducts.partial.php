<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><div class="text-truncate" style="max-width: 250px;"><?php echo $row['description']; ?></div></td>
    <td><?php echo $row['productImg']; ?></td>
    <td><?php echo $CATEGORIES->showOne($row['categoryId'])['name'] ?></td>
    <td><?php if ($row['featured'] == '1')
        {
            echo 'Ja';
        }
        else if ($row['featured'] == '0')
        {
            echo 'Nee';
        }
        ?></td>
    <td><?php echo $row['stock']; ?></td>

    <td>
        <form action="<?=Request::buildUri("/admin/producten/bewerken")?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button class="fa fa-pencil" type="submit" value="Bewerk product">
        </form>
        <form class="deleteProduct" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button class="fa fa-trash" type="submit" data-bs-toggle="modal" data-bs-target="#modalDeleteForm" value="Verwijder product">
        </form>
    </td>

</tr>

