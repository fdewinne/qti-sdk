<?php

namespace qtism\data\storage\xml\marshalling;

use qtism\data\QtiComponent;
use qtism\data\state\ResponseDeclaration;
use qtism\common\enums\BaseType;
use qtism\common\enums\Cardinality;
use \DOMElement;
use \InvalidArgumentException;

/**
 * Marshalling/Unmarshalling implementation for responseDeclaration.
 * 
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 *
 */
class ResponseDeclarationMarshaller extends VariableDeclarationMarshaller {
	
	/**
	 * Marshall an ResponseDeclaration object into a DOMElement object.
	 * 
	 * @param QtiComponent $component A ResponseDeclaration object.
	 * @return DOMElement The according DOMElement object.
	 */
	protected function marshall(QtiComponent $component) {
		$element = parent::marshall($component);
		$baseType = $component->getBaseType();
		
		if ($component->getCorrectResponse() !== null) {
			$marshaller = $this->getMarshallerFactory()->createMarshaller($component->getCorrectResponse(), array($baseType));
			$element->appendChild($marshaller->marshall($component->getCorrectResponse()));
		}
		
		if ($component->getMapping() !== null) {
			$marshaller = $this->getMarshallerFactory()->createMarshaller($component->getMapping(), array($baseType));
			$element->appendChild($marshaller->marshall($component->getMapping()));
		}
		
		if ($component->getAreaMapping() !== null) {
			$marshaller = $this->getMarshallerFactory()->createMarshaller($component->getAreaMapping());
			$element->appendChild($marshaller->marshall($component->getAreaMapping()));
		}
		
		return $element;
	}
	
	/**
	 * Unmarshall a DOMElement object corresponding to a QTI responseDeclaration element.
	 * 
	 * @param DOMElement $element A DOMElement object.
	 * @return QtiComponent A ResponseDeclaration object.
	 * @throws UnmarshallingException 
	 */
	protected function unmarshall(DOMElement $element) {
		
		try {
			$baseComponent = parent::unmarshall($element);
			$object = new ResponseDeclaration($baseComponent->getIdentifier());
			$object->setBaseType($baseComponent->getBaseType());
			$object->setCardinality($baseComponent->getCardinality());
			$object->setDefaultValue($baseComponent->getDefaultValue());
			
			$correctResponseElts = self::getChildElementsByTagName($element, 'correctResponse');
			if (count($correctResponseElts) === 1) {
				$correctResponseElt = $correctResponseElts[0];
				$marshaller = $this->getMarshallerFactory()->createMarshaller($correctResponseElt, array($baseComponent->getBaseType()));
				$object->setCorrectResponse($marshaller->unmarshall($correctResponseElt));
			}
			
			$mappingElts = self::getChildElementsByTagName($element, 'mapping');
			if (count($mappingElts) === 1) {
				$mappingElt = $mappingElts[0];
				$marshaller = $this->getMarshallerFactory()->createMarshaller($mappingElt, array($baseComponent->getBaseType()));
				$object->setMapping($marshaller->unmarshall($mappingElt));
			}
			
			$areaMappingElts = self::getChildElementsByTagName($element, 'areaMapping');
			if (count($areaMappingElts) === 1) {
				$areaMappingElt = $areaMappingElts[0];
				$marshaller = $this->getMarshallerFactory()->createMarshaller($areaMappingElt);
				$object->setAreaMapping($marshaller->unmarshall($areaMappingElt));
			}
			
			return $object;
		}
		catch (InvalidArgumentException $e) {
			$msg = "An unexpected error occured while unmarshalling the responseDeclaration.";
			throw new UnmarshallingException($msg, $element, $e);
		}
	}
	
	public function getExpectedQtiClassName() {
		return 'responseDeclaration';
	}
}