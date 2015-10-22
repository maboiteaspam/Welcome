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


<?php $this->inlineTo('last'); ?>
<script>
    (function () {
        var form = $("#myForm");
        form.ajaxForm({
            dataType: 'json',
            success: window.CHelpers.formErrorProcessor(form)
        });
        form.on('reset', function () {
            form.find('.errors').remove()
        })
    })();
</script>
<?php $this->endInline(); ?>
