<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td>
        <form class="editCategory">
            <input type="hidden" name="categoryId" value="<?= $row['id'] ?>">
            <button type="submit" class="fa fa-pencil" data-bs-toggle="modal" data-bs-target="#modalEditForm" value="Bewerk categorie" />
        </form>
        <form class="deleteCategory" method="post">
            <input type="hidden" name="categoryId" value="<?= $row['id'] ?>">
            <button class="fa fa-trash" type="submit" data-bs-toggle="modal" data-bs-target="#modalDeleteForm" value="Verwijder categorie">
        </form>
    </td>
</tr>
