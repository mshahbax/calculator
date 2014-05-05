<?php
/**
 * Termianal Classs behaves like a terminal where all elements passes through it.
 */
abstract class TerminalExpression {
 
    protected $value = '';
 
    public function __construct($value) {
        $this->value = $value;
    }
 /**
  * 
  * @param TerminalExpression $value Operator
  * @return \TerminalExpression|Number|\Addition|\Subtraction|\Multiplication|\Division|\Parenthesis Validations
  * @throws Exception Throws exception if values is incorect or mismatched.
  */
    public static function factory($value) {
        if (is_object($value) && $value instanceof TerminalExpression) {
            return $value;
        } elseif (is_numeric($value)) {
            return new Number($value);
        } elseif ($value == '+') {
            return new Addition($value);
        } elseif ($value == '-') {
            return new Subtraction($value);
        } elseif ($value == '*') {
            return new Multiplication($value);
        } elseif ($value == '/') {
            return new Division($value);
        } elseif (in_array($value, array('(', ')'))) {
            return new Parenthesis($value);
        }
        throw new Exception('Undefined Value ' . $value);
    }
 
    abstract public function operate(Stack $stack);
 
    public function isOperator() {
        return false;
    }
 
    public function isParenthesis() {
        return false;
    }
 
    public function isNoOp() {
        return false;
    }
 
    public function render() {
        return $this->value;
    }
}
