<?php

use Service\DataService;
use Model\Campus;

class DataServiceTest extends \PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->dataManager = DataService::getInstance("tests/fixture");
		$this->campus = new Campus("Paris", "Ile de France");
	}

	public function testIsSingleton() { 
		$this->assertInstanceOf(DataService::class, $this->dataManager);
	}

	/**
	 * @covers \Service\DataService::path
	*/
	public function testSingletonPath() {
		$this->assertEquals("tests/fixture", $this->dataManager->path());
	}

	/**
	 * @covers \Service\DataService::save
	*/
	public function testSaveOneCampus() {
		$filename = hash("md5", json_encode($this->campus, JSON_PRETTY_PRINT));
		$this->assertTrue($this->dataManager->save($this->campus));
		$this->assertFileExists('tests/fixture/campus/'.$filename);
	}

	/**
	 * @covers \Service\DataService::remove
	*/
	public function testRemoveOneCampus() {
		$filename = hash("md5", json_encode($this->campus, JSON_PRETTY_PRINT));
		$this->assertTrue($this->dataManager->remove($this->campus));
		$this->assertFalse(file_exists('tests/fixture/campus/'.$filename));
	}

	/**
	 * @covers \Service\DataService::getAll
	*/
	public function testgetAllOnCampusWhenEmpty() {
		$this->assertEquals(0, count(json_decode($this->dataManager->getAll("campus"))));	
	}

	/**
	 * @covers \Service\DataService::getAll
	*/
	public function testgetAllOnCampusWhenNotEmpty() {
		$this->dataManager->save($this->campus);
		$this->assertEquals(1, count(json_decode($this->dataManager->getAll("campus"))));	
	}

	/**
	 * @covers \Service\DataService::getAll
	 * @expectedException \Exception\DataException
	*/
	public function testgetAllOnNotExistingType() {
		$this->dataManager->getAll("toto");	
	}
}