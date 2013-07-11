<?php

namespace qtism\data\storage\xml\marshalling;

use qtism\data\QtiComponentCollection;
use qtism\data\QtiComponent;
use qtism\data\expressions\operators\Substring;
use \DOMElement;

/**
 * A complex Operator marshaller focusing on the marshalling/unmarshalling process
 * of substring QTI operators.
 * 
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 *
 */
class SubstringMarshaller extends OperatorMarshaller {
	
	/**
	 * Unmarshall a Substring object into a QTI substring element.
	 * 
	 * @param QtiComponent The Substring object to marshall.
	 * @param array An array of child DOMEelement objects.
	 * @return DOMElement The marshalled QTI substring element.
	 */
	protected function marshallChildrenKnown(QtiComponent $component, array $elements) {
		$element = self::getDOMCradle()->createElement($component->getQtiClassName());
		self::setDOMElementAttribute($element, 'caseSensitive', $component->isCaseSensitive());
		
		foreach ($elements as $elt) {
			$element->appendChild($elt);
		}
		
		return $element;
	}
	
	/**
	 * Unmarshall a QTI substring operator element into a Substring object.
	 *
	 * @param DOMElement The substring element to unmarshall.
	 * @param QtiComponentCollection A collection containing the child Expression objects composing the Operator.
	 * @return QtiComponent A Substring object.
	 * @throws UnmarshallingException
	 */
	protected function unmarshallChildrenKnown(DOMElement $element, QtiComponentCollection $children) {
		$object = new Substring($children);
		
		if (($caseSensitive = static::getDOMElementAttributeAs($element, 'caseSensitive', 'boolean')) !== null) {
			$object->setCaseSensitive($caseSensitive);
		}

		return $object;
	}
}