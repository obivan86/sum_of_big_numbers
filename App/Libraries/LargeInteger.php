<?php

namespace App\Libraries;

class LargeInteger
{
    private $numInt;
    
    public function __construct($numInt) {
        if ($numInt < 0) {
            throw new \InvalidArgumentException("Number must be positive");
        }
        if(intval($numInt) == 0){
			$this->numInt = intval($numInt);
		} else {
			$this->numInt = $numInt;
		}
    }
    
    
    public function getValue() {
        return $this->numInt;
    }
    
    
    public function equalTo(LargeInteger $int) {
        return (strcmp($this->getValue(), $int->getValue()) === 0);
    }
    
    public function notEqualTo(LargeInteger $int) {
        return (strcmp($this->getValue(), $int->getValue()) !== 0);
    }
    
    public function greaterThan(LargeInteger $int) {
        
        if (strlen($this->getValue()) > strlen($int->getValue())) {
            return true;
        } elseif (strlen($this->getValue()) < strlen($int->getValue())) {
            return false;
        }
        
        for ($i = 0; $i < strlen($int->getValue()); $i++) {
            // compare $i-th number
            $a = substr($this->getValue(), $i, 1);
            $b = substr($int->getValue(), $i, 1);
            if ($a > $b) {
                return true;
            } elseif ($a < $b) {
                return false;
            }
        }
        return false;
    }
    
    public function lessThan(LargeInteger $int) {
        
        if (strlen($this->getValue()) < strlen($int->getValue())) {
            return true;
        } elseif (strlen($this->getValue()) > strlen($int->getValue())) {
            return false;
        }
        
        // both numbers have equal lenght, needs to be compared number by number
        for ($i = 0; $i < strlen($int->getValue()); $i++) {
            // compare $i-th number
            $a = substr($this->getValue(), $i, 1);
            $b = substr($int->getValue(), $i, 1);
            if ($a < $b) {
                return true;
            } elseif ($a > $b) {
                return false;
            }
        }
        
        return false;
    }
    
    public function greaterOrEqualThan(LargeInteger $int) {
        if (strlen($this->getValue()) == strlen($int->getValue())) {
            for ($i = 0; $i < strlen($int->getValue()); $i++) {
                // compare $i-th number
                $a = substr($this->getValue(), $i, 1);
                $b = substr($int->getValue(), $i, 1);
                if ($a == $b) {
                    continue;
                } elseif ($a > $b) {
                    return true;
                }
                return false;
            }
        } elseif (strlen($this->getValue()) < strlen($int->getValue())) {
            return false;
        }
        
        return true;
    }
    
    public function lessOrEqualThan(LargeInteger $int) {
        if (strlen($this->getValue()) == strlen($int->getValue())) {
            
            // both numbers have equal lenght, needs to be compared number by number
            for ($i = 0; $i < strlen($int->getValue()); $i++) {
                
                // compare $i-th number
                $a = substr($this->getValue(), $i, 1);
                $b = substr($int->getValue(), $i, 1);
                if ($a == $b) {
                    continue;
                } else if ($a < $b) {
                    return true;
                }
                return false;
            }
        } elseif (strlen($this->getValue()) > strlen($int->getValue())) {
            return false;
        }
        
        return true;
    }
    
    public function add(LargeInteger $int) {
        if (strlen($this->getValue()) > strlen($int->getValue())) {
            $padLength = strlen($this->getValue());
            $padInt = str_pad($int->getValue(), $padLength, '0', STR_PAD_LEFT);
            $result = $this->sum($this, $padInt);
            return new LargeInteger($result);
        } elseif (strlen($this->getValue()) < strlen($int->getValue())) {
            $padLength = strlen($int->getValue());
            $padInt = str_pad($this->getValue(), $padLength, '0', STR_PAD_LEFT);
            $result = $this->sum($int, $padInt);
            return new LargeInteger($result);
        }
        $result = $this->sum($int, $this->getValue());
        return new LargeInteger($result);
    }


    private function sum($larger, $padInt, $rest = 0){
        $result = '';
        for ($i = strlen($larger->getValue()); $i > 0; $i--) {
            $a = substr($larger->getValue(), $i - 1, 1);
            $b = substr($padInt, $i - 1, 1);
            $a = $a + $rest;
            if (($a + $b) >= 10) {
                $rest = 1;
                if ($i != 1) {
                    $sum = substr(($a + $b), 1);
                } else {
                    $sum = $a + $b;
                }
            } else {
                $rest = 0;
                $sum = $a + $b;
            }

            $result = $sum . $result;
        }
        return $result;
    }


}
