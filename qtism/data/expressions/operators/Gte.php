<?php

namespace qtism\data\expressions\operators;

use qtism\data\expressions\ExpressionCollection;

/**
 * From IMS QTI:
 * 
 * The gte operator takes two sub-expressions which must both have single cardinality
 * and have a numerical base-type. The result is a single boolean with a value of 
 * true if the first expression is numerically greater than or equal to the second 
 * and false if it is less than the second. If either sub-expression is NULL then 
 * the operator results in NULL.
 * 
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 *
 */
class Gte extends Operator {
	
	public function __construct(ExpressionCollection $expressions) {
		parent::__construct($expressions, 2, 2, array(OperatorCardinality::SINGLE), array(OperatorBaseType::INTEGER, OperatorBaseType::FLOAT));
	}
	
	public function getQtiClassName() {
		return 'gte';
	}
}