<?php
/* Bugs Test cases generated on: 2011-06-04 00:09:23 : 1307171363*/
App::import('Controller', 'Bugs');

class TestBugsController extends BugsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BugsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.bug', 'app.user', 'app.note');

	function startTest() {
		$this->Bugs =& new TestBugsController();
		$this->Bugs->constructClasses();
	}

	function endTest() {
		unset($this->Bugs);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
