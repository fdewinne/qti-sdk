<?php
/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *   
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * 
 * Copyright (c) 2013-2014 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 * 
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 * @license GPLv2
 */

namespace qtism\data\storage\xml\marshalling;

use qtism\data\QtiComponent;
use qtism\data\expressions\NumberSelected;
use \DOMElement;

/**
 * A marshalling/unmarshalling implementation for the QTI numberSelected expression.
 * 
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 *
 */
class NumberSelectedMarshaller extends ItemSubsetMarshaller {
	
	/**
	 * Marshall an NumberSelected object in its DOMElement equivalent.
	 * 
	 * @param \qtism\data\QtiComponent $component A NumberSelected object.
	 * @return \DOMElement The corresponding numberSelected QTI element.
	 */
	protected function marshall(QtiComponent $component) {
		$element = parent::marshall($component);
		return $element;
	}
	
	/**
	 * Marshall an numberSelected QTI element in its NumberSelected object equivalent.
	 * 
	 * @param \DOMElement $element A DOMElement object.
	 * @return \qtism\data\QtiComponent The corresponding NumberSelected object.
	 */
	protected function unmarshall(DOMElement $element) {
		$baseComponent = parent::unmarshall($element);
		$object = new NumberSelected();
		$object->setSectionIdentifier($baseComponent->getSectionIdentifier());
		$object->setIncludeCategories($baseComponent->getIncludeCategories());
		$object->setExcludeCategories($baseComponent->getExcludeCategories());
			
		return $object;
	}
	
	/**
	 * @see \qtism\data\storage\xml\marshalling\ItemSubsetMarshaller::getExpectedQtiClassName()
	 */
	public function getExpectedQtiClassName() {
		return 'numberSelected';
	}
}
