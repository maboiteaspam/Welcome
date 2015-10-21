<?php
/* @var $this \C\View\ConcreteContext */
/* @var $form \Symfony\Component\Form\FormView */
?>

Some data..


<?php
echo $this->form_start($myForm);
echo $this->form_rows($myForm);
echo $this->form_end($myForm);
?>
