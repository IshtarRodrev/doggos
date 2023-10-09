
<?php if($dog->getErrors()): ?>
<div class="alert alert-danger">
    <b>Не получилось сохранить собаку. Ошибки:</b>
    <ul>
        <?php foreach ($dog->getErrors() as $error): ?>
        <li><?=$error?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif;?>

<form method="post">
    <div class="row">
        <div class="col-3">
            <label class="form-label">Кличка</label>
            <input class="form-control" type="text" name="name" placeholder="кличка" value="<?=$dog->getName()??''?>">
        </div>
        <div class="col-3">
            <label class="form-label">Порода</label>
            <select class="form-select" name="breed">
                <?php foreach(Breed::cases() as $item): ?>
                    <option value="<?=$item->value?>" <?=($item->value == $dog->getBreed()) ? 'selected ': ''?>><?=$item->ToString()?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-3">
            <label class="form-label">Материал</label>
            <select class="form-select" name="material">
                <?php foreach(Material::cases() as $item): ?>
                    <option value="<?=$item->value?>" <?=($item->value == $dog->getMaterial()) ? 'selected ': ''?>><?=$item->ToString()?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-3">
            <label class="form-label">Звук</label>
            <select class="form-select" name="sound">
                <?php foreach(Sound::cases() as $item): ?>
                    <option value="<?=$item->value?>" <?=($item->value == $dog->getSound()) ? 'selected ': ''?>><?=$item->ToString()?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-check">
                <br>
                <input class="form-check-input" type="checkbox" value="" id="checkboxIsHunter" name="is_hunter" value="1" <?=$dog->getIs_hunter() ? 'checked ': ''?>>
                <label class="form-check-label" for="checkboxIsHunter">
                    умеет охотиться
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <br>
            <?php if ($_SERVER['REQUEST_URI']=='/add.php'):?>
                <input class="btn btn-primary" type="submit" name="add" value="добавить собакена">
            <?php else:?>
                <input class="btn btn-primary" type="submit" name="edit" value="редактировать">
            <?php endif;?>
        </div>
    </div>
</form>
