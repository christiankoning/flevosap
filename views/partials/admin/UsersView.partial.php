<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['isAdmin']; ?></td>
    <td><?php echo $row['type']; ?></td>
    <td><?php echo $row['active']; ?></td>
    <td><?php echo $row['createdAt']; ?></td>
    <td><?php echo $row['updatedAt']; ?></td>

    <td>
        <form class="editUser">
            <input type="hidden" name="userId" value="<?=    $row['id'] ?>">
            <button type="submit" class="fa fa-pencil" data-bs-toggle="modal" data-bs-target="#modalEditForm" value="Bewerk gebruiker" />
        </form>
        <form class="deleteUser" method="post">
            <input type="hidden" name="userId" value="<?= $row['id'] ?>">
            <button class="fa fa-trash" type="submit" data-bs-toggle="modal" data-bs-target="#modalDeleteForm" value="Verwijder Gebruiker">
        </form>
    </td>

</tr>
