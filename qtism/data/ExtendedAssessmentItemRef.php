<?php

namespace qtism\data;

use qtism\data\state\ResponseDeclaration;
use qtism\data\state\OutcomeDeclaration;
use qtism\data\state\ResponseDeclarationCollection;
use qtism\data\state\OutcomeDeclarationCollection;
use qtism\data\state\ResponseProcessing;
use qtism\data\AssessmentItemRef;
use qtism\common\collections\IdentifierCollection;

/**
 * The ExtendedAssessmentItemRef class is an extended representation of the QTI
 * assessmentItemRef class. It gathers together the assessmentItemRef + the
 * outcome/responseDeclarations of the referenced item in a single component.  
 * 
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 *
 */
class ExtendedAssessmentItemRef extends AssessmentItemRef {
	
	/**
	 * The outcomeDeclarations found in the referenced assessmentItem.
	 * 
	 * @var OutcomeDeclarationCollection
	 */
	private $outcomeDeclarations;
	
	/**
	 * The responseDeclarations found in the referenced assessmentItem.
	 * 
	 * @var ResponseDeclarationCollection
	 */
	private $responseDeclarations;
	
	/**
	 * The responseProcessing found in the referenced assessmentItem
	 * 
	 * @var ResponseProcessing
	 */
	private $responseProcessing = null;
	
	/**
	 * Create a new instance of CompactAssessmentItem
	 * 
	 * @param string $identifier A QTI Identifier.
	 * @param string $href The URL to locate the referenced assessmentItem.
	 * @param IdentifierCollection $categories Optional categories.
	 * @throws InvalidArgumentException if $identifier is not a valid QTI Identifier or $href is not a valid URI.
	 */
	public function __construct($identifier, $href, IdentifierCollection $categories = null) {
		parent::__construct($identifier, $href, $categories);
		
		$this->setOutcomeDeclarations(new OutcomeDeclarationCollection());
		$this->setResponseDeclarations(new ResponseDeclarationCollection());
	}
	
	/**
	 * Set the outcomeDeclarations found in the referenced assessmentItem.
	 * 
	 * @param OutcomeDeclarationCollection $outcomeDeclarations A collection of OutcomeDeclaration objects.
	 */
	public function setOutcomeDeclarations(OutcomeDeclarationCollection $outcomeDeclarations) {
		$this->outcomeDeclarations = $outcomeDeclarations;
	}
	
	/**
	 * Get the outcomeDeclarations found in the referenced assessmentItem.
	 * 
	 * @return OutcomeDeclarationCollection A collection of OutcomeDeclaration objects.
	 */
	public function getOutcomeDeclarations() {
		return $this->outcomeDeclarations;
	}
	
	/**
	 * Set the responseProcessing found in the referenced assessmentItem.
	 * 
	 * @param ResponseProcessing $responseProcessing A ResponseProcessing object or null if no response processing described.
	 */
	public function setResponseProcessing(ResponseProcessing $responseProcessing = null) {
		$this->responseProcessing = $responseProcessing;
	}
	
	/**
	 * Get the responseProcessing found in the referenced assessmentItem.
	 * 
	 * @return ResponseProcessing A ResponseProcessing object or null if no response processing described. 
	 */
	public function getResponseProcessing() {
		return $this->responseProcessing;
	}
	
	/**
	 * Whether the referenced assessmentITem has a responseProcessing entry.
	 * 
	 * @return boolean
	 */
	public function hasResponseProcessing() {
		return $this->getResponseProcessing() !== null;
	}
	
	/**
	 * Add an OutcomeDeclaration object.
	 * 
	 * @param OutcomeDeclaration $outcomeDeclaration An OutcomeDeclaration object.
	 */
	public function addOutcomeDeclaration(OutcomeDeclaration $outcomeDeclaration) {
		$this->getOutcomeDeclarations()->attach($outcomeDeclaration);
	}
	
	/**
	 * Remove an OutcomeDeclaration object from the current one.
	 * 
	 * @param OutcomeDeclaration $outcomeDeclaration An OutcomeDeclaration object.
	 */
	public function removeOutcomeDeclaration(OutcomeDeclaration $outcomeDeclaration) {
		$this->getOutcomeDeclarations()->detach($outcomeDeclaration);
	}
	
	/**
	 * Set the responseDeclarations found in the referenced assessmentItem.
	 * 
	 * @param ResponseDeclarationCollection $responseDeclarations A collection of ResponseDeclaration objects.
	 */
	public function setResponseDeclarations(ResponseDeclarationCollection $responseDeclarations) {
		$this->responseDeclarations = $responseDeclarations;
	}
	
	/**
	 * Get the responseDeclarations found in the referenced assessmentItem.
	 * 
	 * @return ResponseDeclarationCollection A collection of ResponseDeclaration objects.
	 */
	public function getResponseDeclarations() {
		return $this->responseDeclarations;
	}
	
	/**
	 * Add a ResponseDeclaration object.
	 * 
	 * @param ResponseDeclaration $responseDeclaration A ResponseDeclaration object.
	 */
	public function addResponseDeclaration(ResponseDeclaration $responseDeclaration) {
		$this->getResponseDeclarations()->attach($responseDeclaration);
	}
	
	/**
	 * Remove a ResponseDeclaration object.
	 * 
	 * @param ResponseDeclaration $responseDeclaration A ResponseDeclaration object.
	 */
	public function removeResponseDeclaration(ResponseDeclaration $responseDeclaration) {
		$this->getResponseDeclarations()->detach($responseDeclaration);
	}
	
	/**
	 * Create a new ExtendedAssessmentItemRef object from an AssessmentItemRef object.
	 * 
	 * @param AssessmentItemRef $assessmentItemRef An AssessmentItemRef object.
	 * @return ExtendedAssessmentItemRef A ExtendedAssessmentItemRef object.
	 */
	public static function createFromAssessmentItemRef(AssessmentItemRef $assessmentItemRef) {
		$identifier = $assessmentItemRef->getIdentifier();
		$href = $assessmentItemRef->getHref();
		$compactRef = new static($identifier, $href);
		$compactRef->setBranchRules($assessmentItemRef->getBranchRules());
		$compactRef->setCategories($assessmentItemRef->getCategories());
		$compactRef->setFixed($assessmentItemRef->isFixed());
		$compactRef->setItemSessionControl($assessmentItemRef->getItemSessionControl());
		$compactRef->setPreConditions($assessmentItemRef->getPreConditions());
		$compactRef->setRequired($assessmentItemRef->isRequired());
		$compactRef->setTemplateDefaults($assessmentItemRef->getTemplateDefaults());
		
		return $compactRef;
	}
}