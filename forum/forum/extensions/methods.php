<?php

field::$methods['clean'] = function($field) {
  $field->value = htmlawed(kirbytext($field->value));
  return $field;
};