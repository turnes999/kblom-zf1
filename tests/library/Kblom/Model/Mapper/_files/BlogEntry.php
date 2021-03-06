<?php
require_once 'Kblom/Model/Mapper/Entity.php';

class Model_Mapper_BlogEntry extends Kblom_Model_Mapper_Entity
{
	public function find($id)
	{
		if ($this->_hasIdentity($id)) {
			return $this->_getIdentity($id);
		}
		$rowset = $this->getDbTable()->find($id);

		if ($rowset->count() != 1) {
			return;
		}
		$row = $rowset->current();

		$entry = new Model_BlogEntry(array(
			'id'      => $row->id,
			'title'   => $row->title,
			'content' => $row->content,
		));
		$entry->setReferenceId('author', $row->author_id);

		$this->_setIdentity($id, $entry);
		return $entry;
	}
}
