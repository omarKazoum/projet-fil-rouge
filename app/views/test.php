<form action="<?= getUrlFor('test') ?>" method="post" enctype="multipart/form-data">
    <pre>
        <?php print_r(\core\InputValidator::getErrors()) ?>
    </pre>
    <input type="file" name="image" id="">
    <input type="submit" value="send">
</form>