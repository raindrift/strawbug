<?php
/* Notes Test cases generated on: 2011-06-03 23:34:55 : 1307169295*/
App::import('Controller', 'Notes');

class TestNotesController extends NotesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class NotesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.note', 'app.user', 'app.bug');

	function startTest() {
		$this->Notes =& new TestNotesController();
		$this->Notes->constructClasses();
	}

	function endTest() {
		unset($this->Notes);
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
