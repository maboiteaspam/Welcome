<?php
namespace C\Welcome;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class FormDemo
 * Demonstrates how to create a data holder
 * for form submission with constraints validation
 * attached to it.
 *
 * It is regular symfony style.
 *
 * @package C\Welcome
 */
class FormDemo{
    /*
     * As of symfony rules,
     * if you attach an object to your form (createFormBuilder($object...);)
     * It must have a property for each field in the form.
     * see also per element mapped option.
     */

    public $email;
    public $name;
    public $names;
    public $edmType;
    public $velocity;
    public $preferences;
    public $date;
    public $datetime;
    public $time;
    public $single_checkbox;
    public $single_radio;
    public $file_upload;
    public $password;
    public $hidden_field;

    /**
     * Attach new constraint on name property to require a min-length=20
     *
     * @param ClassMetadata $metadata
     */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\Length(array('min' => 20)));
        // then you can add more like this.

        // beware that they are not de duplicated with those created from layout files.

//        $metadata->addPropertyConstraint('name', new Assert\NotBlank([]));
//        $metadata->addPropertyConstraint('properties', new Assert\Valid([]));
    }
}
