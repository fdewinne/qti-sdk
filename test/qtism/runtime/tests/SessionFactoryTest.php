<?php

use qtism\common\datatypes\Duration;
use qtism\data\storage\xml\XmlCompactDocument;
use qtism\data\AssessmentTest;
use qtism\runtime\tests\SessionFactory;

require_once (dirname(__FILE__) . '/../../../QtiSmTestCase.php');


class SessionFactoryTest extends QtiSmTestCase {
	
    private $test;
    
    public function setUp() {
        parent::setUp();
        
        $test = new XmlCompactDocument();
        $test->load(self::samplesDir() . 'custom/runtime/linear_5_items.xml');
        $this->setTest($test->getDocumentComponent());
    }
    
    public function tearDown() {
        parent::tearDown();
        unset($this->test);
    }
    
    /**
     * 
     * @param AssessmentTest $test
     */
    private function setTest(AssessmentTest $test) {
        $this->test = $test;
    }
    
    /**
     * 
     * @return AssessmentTest
     */
    private function getTest() {
        return $this->test;
    }
    
    public function testDefaultAssessmentTestSessionCreation() {
        // Default acceptable latency is PT0S.
        // default considerMinTime is true.
        $factory = new SessionFactory();
        $session = $factory->createAssessmentTestSession($this->getTest());
        
        $this->assertInstanceOf('qtism\\runtime\\tests\\AssessmentTestSession', $session);
        $this->assertTrue($session->mustConsiderMinTime());
        $this->assertTrue($session->getAcceptableLatency()->equals(new Duration('PT0S')), 'The default acceptable latency must be PT0S');
    }
    
    public function testParametricAssessmentTestSessionCreation() {
        $acceptableLatency = new Duration('PT5S');
        $considerMinTime = false;
        
        $factory = new SessionFactory();
        $factory->setAcceptableLatency($acceptableLatency);
        $factory->setConsiderMinTime($considerMinTime);
        
        $session = $factory->createAssessmentTestSession($this->getTest());
        
        $this->assertInstanceOf('qtism\\runtime\\tests\\AssessmentTestSession', $session);
        $this->assertFalse($session->mustConsiderMinTime());
        $this->assertTrue($session->getAcceptableLatency()->equals(new Duration('PT5S')), 'The custom acceptable latency must be PT5S');
    }
}