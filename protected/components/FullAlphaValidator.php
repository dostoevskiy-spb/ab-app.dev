<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mota-systems
 * Date: 15.02.13
 * Time: 21:26
 * To change this template use File | Settings | File Templates.
 */
class FullAlphaValidator extends CValidator
{
    public $utf8 = FALSE;
    private $utf8pattern = '/^[-\pL\pN_-]++$/uD';
    private $latPattern = '/^[-a-z0-9_]++$/iD';

    /**
     * Validates a single attribute.
     * This method should be overridden by child classes.
     * @param CModel $object the data object being validated
     * @param string $attribute the name of the attribute to be validated.
     */
    protected function validateAttribute($object, $attribute)
    {
        if ($this->utf8) {
            if (!(preg_match($this->utf8pattern, $object->$attribute))) {
                $message = $this->message !== NULL ? $this->message : '{attribute} может содержать только латинские буквы, цифры, символ подчеркивания или тире';
                $this->addError($object, $attribute, $message);
            }
        } else {
            if (!preg_match($this->latPattern, $object->$attribute)) {
                $message = $this->message !== NULL ? $this->message : '{attribute} может содержать только буквы, цифры, символ подчеркивания или тире';
                $this->addError($object, $attribute, $message);
            }
        }
    }

    public function clientValidateAttribute($object, $attribute)
    {
        $label = $object->getAttributeLabel($attribute);
        if (($message = $this->message) === NULL)
            $message = $this->allowDash ? '{attribute} может содержать только буквы или тире' : '{attribute} может содержать только буквы';
        $message = $this->message !== NULL ? $this->message : $message;
        $message = strtr($message, array(
            '{attribute}' => $label,
        ));
        if ($this->allowDash) {
            $js = "if(!value.match($this->allowDashPattern)) {
	                messages.push(" . CJSON::encode($message) . ");
                }";
        } else {
            $js = "if(!value.match($this->refuseDashPattern)) {
	                messages.push(" . CJSON::encode($message) . ");
                }";
        }
        return $js;
    }
}
