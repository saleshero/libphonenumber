<?php

/**
 * PhoneNumberFormatter{ 
 * 
 * @package 
 * @version $id$
 * @copyright Copyright (C) 2012 Flasybay Inc. All rights reserved.
 * @author Acky <Acky@flashbay.com> 
 * @license flashbay {@link http://www.flashbay.com}
 * @package    SalesHero
 */
namespace SalesHero\Libraries\Libphonenumber;

require_once 'PhoneNumberUtil.php';

use com\google\i18n\phonenumbers\PhoneNumberUtil;
use com\google\i18n\phonenumbers\PhoneNumberFormat;
use com\google\i18n\phonenumbers\NumberParseException;

class PhoneNumberFormatter{
    protected $rawPhoneNumber;
    protected $phoneNumberProto;
    protected $phoneUtil;

    public function __construct($rawPhoneNumber)
    {
        $this->rawPhoneNumber = $rawPhoneNumber;
        $this->phoneUtil = PhoneNumberUtil::getInstance();
        $this->phoneNumberProto = $this->phoneUtil->normalize($rawPhoneNumber);
        try {
            $this->phoneNumberProto = $this->phoneUtil->parseAndKeepRawInput($rawPhoneNumber, 'ZZ');
        } catch (NumberParseException $e) {
            //Do nothing
        }
    }

    public function isPossible()
    {
        return is_string($this->phoneNumberProto);
    }

    public function isValid()
    {
        return is_string($this->phoneNumberProto) ? false : $this->phoneUtil->isValidNumber($this->phoneNumberProto);
    }

    public function formatPhoneNumber($type = 0)
    {
        if($this->rawPhoneNumber[0] == '+'){
            $symbol = '+';
        }
        return is_string($this->phoneNumberProto) ?  ($symbol . $this->phoneNumberProto) : $this->phoneUtil->format($this->phoneNumberProto, $type);
    }
}
