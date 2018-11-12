<?php
	class Test {
		//muutujad ehk properties
		private $secretNumber = 7;
		public $publicNumber;
		
		//funktsioonid on meetodid
		//construcor, mis käivitub klassi kasutusele võtmisel
		function __construct($givenNumber) {
			$this->secretNumber = 7;
			$this->publicNumber = $givenNumber * $this->secretNumber;
		}
		
		//destrucot mis käivitub klassi eemaldumisel
		function __destruct() {
			echo "Klass lõpetab tegevuse";
		}
		
		public function showValues() {
			echo "Salajane number on:" .$this->secretNumber;
			$this->tellInfo();
		}
		private function tellInfo() {
			echo "See info on väga salajane";
		}
		
	} //klass lõppeb
?>