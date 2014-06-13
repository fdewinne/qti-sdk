<?php

use qtism\data\AssessmentTest;
use qtism\runtime\tests\AssessmentItemSession;
use qtism\data\IAssessmentItem;
use qtism\runtime\tests\AbstractSessionFactory;
use qtism\runtime\tests\Route;
use qtism\runtime\tests\TestResultsSubmission;

class SimpleResultsSubmittableTestSessionFactory extends AbstractSessionFactory {
    
    protected function instantiateAssessmentTestSession(AssessmentTest $test, Route $route) {
        return new SimpleResultsSubmittableTestSession($test, $this, $route);
    }
    
    protected function instantiateAssessmentItemSession(IAssessmentItem $assessmentItem, $navigationMode, $submissionMode) {
        return new AssessmentItemSession($assessmentItem, $this, $navigationMode, $submissionMode);
    }
}