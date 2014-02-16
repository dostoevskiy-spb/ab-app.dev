<?php
class CCFormatter extends CFormatter {
    public $numOfWords = 5;

    public function formatTtext($value) {
        $value = CHtml::encode($value);

        $lenBefore = strlen($value);

        if($this->numOfWords){
            if(preg_match("/\s*(\S+\s*){0,$this->numOfWords}/", $value, $match)){
                $value = trim($match[0]);
            }
            if(strlen($value) != $lenBefore){
                $value .= ' ...';
            }
        }

        return $value;
    }
}