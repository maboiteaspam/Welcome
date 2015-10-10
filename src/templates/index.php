<?php
/* @var $this \C\View\ConcreteContext */
/* @var $layouts array */
/* @var $errors array */
?>

<div class="welcome">
    <?php echo $this->upper($this->trans("welcome")); ?>
    <br/>
    <?php echo $this->upper($this->trans("welcome3")); ?>
    <br/>
    <?php echo $this->upper($this->trans("welcome4")); ?>
</div>


<?php if (count($errors)) { ?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error ?></li>
            <?php } ?>
        </ul>
    </div>

<?php } else { ?>
    <div class="layouts">
        <ul>
            <?php foreach ($layouts as $layout) { ?>
                <li><a href="<?php echo $layout ?>"><?php echo $layout ?></a> </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>


