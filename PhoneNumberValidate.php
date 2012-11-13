<?php
/**
 * PhoneNumberValidate 
 * 
 * @uses Zend
 * @package 
 * @version $id$
 * @copyright Copyright (C) 2012 Flasybay Inc. All rights reserved.
 * @author Acky <acky@flashbay.com> 
 * @license flashbay {@link http://www.flashbay.com}
 */
namespace SalesHero\Libraries\Libphonenumber;

class PhoneNumberValidate extends \Zend\Validator\AbstractValidator
{
    const MSG_PHONENUMBER = 'msgPhoneNumber';

    protected $messageTemplates = array(
        self::MSG_PHONENUMBER => "Please enter a valid phone number"
    );

    public function isValid($value)
    {
        for($i = 0; $i <= 5; $i++){
            $phoneNumberFormatter = new \SalesHero\Libraries\Libphonenumber\PhoneNumberFormatter($value);
            if($phoneNumberFormatter->isValid()){
                return true;
            }
            $value = strrev(substr(strrev($value), 1));
        }
        $this->error(self::MSG_PHONENUMBER);
        return false;
    }
}
