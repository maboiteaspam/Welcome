<?php
/* @var $this \C\View\ConcreteContext */
/* @var $myForm \Symfony\Component\Form\FormView This is the form object to render. */
?>

<h1>Form demonstration</h1>

The loaded form is defined into src/layouts/formDemo.yml.

<br/>
It demonstrates the use of several filed types.
<br/>

Below is the result of the automatic rendering of each supported fields.
<br/>

<?php
echo $this->form_start($myForm);
echo $this->form_rows($myForm);
echo $this->form_end($myForm);
?>

<br/>

