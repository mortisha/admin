<?php

class Contacts implements ICRUD {
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}


	public function add(IItem $item) {
		$sql = '
			INSERT INTO contacts (name, email, phone, comment) 
			VALUES (
				"'.$item->name.'",
				"'.$item->email.'",
				"'.$item->phone.'",
				"'.$item->comment.'"
			)
		';
		mysqli_query($this->db, $sql);
	}

	public function update($id, IItem $item) {

		$sql = '
			UPDATE contacts 
			SET 
			name = "' . $item->name . '",
			email = "' . $item->email . '"
			WHERE id = ' . $id;

		mysqli_query($this->db, $sql);

	}


	public function delete($id) {

		$sql = '
			DELETE FROM contacts WHERE id = '. $id;

		mysqli_query($this->db, $sql);

	}

	public function get($id) {

		$sql = '
			SELECT * FROM contacts 
			WHERE id = '.$id;

		$res = mysqli_query($this->db, $sql);
		return mysqli_fetch_assoc($res);

	}

	public function getAll() {

		$sql = 'SELECT * FROM contacts';
		$res = mysqli_query($this->db, $sql);
		$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;

	}

























}