<?php
/* @var $this \C\View\ConcreteContext */
/* @var $layouts array An array of relative files path to layout. */
/* @var $errors array An array of system error. */
?>

<div class="welcome">
    <?php
    // $this is a rich helper to create your views.
    // you can get a complete list of method here
    // https://github.com/maboiteaspam/Foundation/blob/master/src/C/View/ConcreteContext.php
    // and their implementation at
    // https://github.com/maboiteaspam/Foundation/tree/master/src/C/View/Helper (beware this url will certainly change!)
    echo $this->upper($this->trans("welcome"));
    ?>
<!--    <br/>-->
<!--    --><?php //echo $this->upper($this->trans("welcome3")); // un-comment this to see language fallback in action ?>
<!--    <br/>-->
<!--    --><?php //echo $this->upper($this->trans("welcome4")); // configure your browser on zh_TW, its translation file is missing welcome4, but zh language has it!
// check src/intl folder.
// ?>
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


