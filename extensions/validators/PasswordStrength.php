<?php
class PasswordStrength extends CValidator
{
 
    public $strength='weak';
 
    private $weak_pattern = '/^(?=.*[a-zA-Z0-9]).{6,}$/';
    private $strong_pattern = '/^(?=.*\d(?=.*\d))(?=.*[a-zA-Z](?=.*[a-zA-Z])).{6,}$/';


	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 * @param CModel $object the object being validated
	 * @param string $attribute the attribute being validated
	 */
	protected function validateAttribute($object,$attribute)
	{
	    // check the strength parameter used in the validation rule of our model
	    if ($this->strength == 'weak')
	      $pattern = $this->weak_pattern;
	    elseif ($this->strength == 'strong')
	      $pattern = $this->strong_pattern;
	 
	    // extract the attribute value from it's model object
	    $value=$object->$attribute;
	    if(!preg_match($pattern, $value))
	    {
	        $this->addError($object,$attribute,Yii::t('app','Your password is too weak! must have at least 6 characters'));
	    }
	}
}