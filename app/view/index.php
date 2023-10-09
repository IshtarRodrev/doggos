<div>
    <h5>Список хороших девочек и мальчиков:</h5>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Кличка</th>
                <th scope="col">Порода</th>
                <th scope="col">Материал</th>
                <th scope="col">Звук</th>
                <th scope="col">Способности</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dogs as $dog): ?>
            <tr>
                <th><?=$dog->getId()?></th>
                <td><?=$dog->getName()?></td>
                <td><?=Breed::from($dog->getBreed())->toString()?></td>
                <td><?=Material::from($dog->getMaterial())->toString()?></td>
                <td><?=Sound::from($dog->getSound())->toString()?></td>
                <td>
                    <?php if ($dog->getIs_hunter() == 1): ?>
                        <div class="badge bg-dark">охотиться</div>
                    <?php endif; ?>

                    <?php if ($dog->getSound() == Sound::SQUEAK->value): ?>
                        <div class="badge bg-dark">пищать</div>
                    <?php endif; ?>

                    <?php if ($dog->getSound() == Sound::BARK->value): ?>
                        <div class="badge bg-dark">лаять</div>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="min-width: 150px;">
                        <a class="btn btn-outline-primary btn-sm" href="edit.php?id=<?=$dog->getId()?>">править</a>
                        <form class="d-inline-block" method="post" action="delete.php">
                            <input type="hidden" name="id" value="<?=$dog->getId()?>">
                            <button type="submit" class="btn btn-outline-dark btn-sm">удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>