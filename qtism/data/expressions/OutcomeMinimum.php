<?php

namespace qtism\data\expressions;

use qtism\common\utils\Format;
use qtism\common\enums\BaseType;
use qtism\common\enums\Cardinality;
use \InvalidArgumentException;

/**
 * From IMS QTI:
 * 
 * This expression, which can only be used in outcomes processing, simultaneously 
 * looks up the normalMinimum value of an outcome variable in a sub-set of the 
 * items referred to in a test. Only variables with single cardinality are considered. 
 * Items with no declared minimum are ignored. The result has cardinality multiple 
 * and base-type float.
 * 
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 *
 */
class OutcomeMinimum extends ItemSubset {
	
	/**
	 * From IMS QTI:
	 * 
	 * As per the variableIdentifier attribute of testVariables.
	 * 
	 * @var string
	 */
	private $outcomeIdentifier;
	
	/**
	 * From IMS QTI:
	 * 
	 * As per the weightIdentifier attribute of testVariables.
	 * 
	 * @var string
	 */
	private $weightIdentifier;
	
	/**
	 * Create a new instance of OutcomeMinimum.
	 * 
	 * @param string $outcomeIdentifier A QTI Identifier.
	 * @param string $weightIdentifier A QTI Identifier or '' (empty string) if not specified.
	 * @throws InvalidArgumentException If one of the arguments is not a valid QTI Identifier.
	 */
	public function __construct($outcomeIdentifier, $weightIdentifier = '') {
		$this->setOutcomeIdentifier($outcomeIdentifier);
		$this->setWeightIdentifier($weightIdentifier);
	}
	
	/**
	 * Set the outcome identifier.
	 * 
	 * @param string $outcomeIdentifier A QTI Identifier.
	 * @throws InvalidArgumentException If $outcomeIdentifier is not a valid QTI Identifier.
	 */
	public function setOutcomeIdentifier($outcomeIdentifier) {
		if (Format::isIdentifier($outcomeIdentifier)) {
			$this->outcomeIdentifier = $outcomeIdentifier;
		}
		else {
			$msg = "'${outcomeIdentifier}' is not a valid QTI Identifier.";
			throw new InvalidArgumentException($msg);
		}
	}
	
	/**
	 * Get the outcome identifier.
	 * 
	 * @return string A QTI Identifier.
	 */
	public function getOutcomeIdentifier() {
		return $this->outcomeIdentifier;
	}
	
	/**
	 * Set the weight identifier. Can be '' (empty string) if no weight specified.
	 * 
	 * @param string $weightIdentifier A QTI Identifier or '' (empty string) if not specified.
	 * @throws InvalidArgumentException If $weightIdentifier is not a valid QTI Identifier nor '' (empty string).
	 */
	public function setWeightIdentifier($weightIdentifier) {
		if (Format::isIdentifier($weightIdentifier) || $weightIdentifier == '') {
			$this->weightIdentifier = $weightIdentifier;
		}
		else {
			$msg = "'${weightIdentifier}' is not a valid QTI Identifier.";
			throw new InvalidArgumentException($msg);
		}
	}
	
	/**
	 * Get the weight identifier. Can be '' (empty string) if no weight was specified.
	 * 
	 * @return string A QTI Identifier or '' (empty string).
	 */
	public function getWeightIdentifier() {
		return $this->weightIdentifier;
	}
	
	public function getQtiClassName() {
		return 'outcomeMinimum';
	}
}