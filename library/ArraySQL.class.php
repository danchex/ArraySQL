<?php
//ArraySQL 实现类

Class ArraySQL
{
	private $_data;
	private $_temp;
	private $_return;

	public function __construct($data = array())
	{
		$this->_data = $data;
		$this->_return = array();
	}

	public function data() {
		return $this->_data;
	}

	public function output($output = 'var_dump') {
		var_dump($this->_return);
	}

	public function find($col = '*')
	{
		$select = explode(',', $col);
		foreach ($this->_data as $i => $row) {
			foreach ($row as $key => $value) {
				if( in_array($key, $select) ) {
					$this->_return[$i][$key] = $value;
				}
			}
		}
		return $this;
	}
	
	public function row($col = '')
	{
		if ($col != '') {
			$this->find($col);
			$this->_temp = $this->_return;
		} else {
			$this->_temp = $this->_data;
		}
		$this->_return = array();

		foreach ($this->_temp as $i => $row) {
			if ($col != '') {
				$this->_return[] = isset($row[$col]) ? $row[$col] : '';
			} else {
				$this->_return[] = array_shift($row);			
			}
		}
		return $this;
	}

	public function order($col = '', $sort = 'ASC')
	{
		if ($col == '') {
			$this->_temp = $this->_data;
		} else {
			$this->_temp = $this->_data;
			foreach ($this->_temp as $i => $row) {
				array_unshift($this->_temp[$i], $row[$col]);
			}
		}
		if (strtoupper($sort) == 'ASC') {
			asort($this->_temp);		
		} else {
			arsort($this->_temp);
		}
		$this->_temp = $this->remove('0', $this->_temp);
		return $this;
	}

	public function remove($col = '', $_data)
	{
		$this->_return = array();
		foreach ($_data as $i => $row) {
			foreach ($row as $key => $value) {
				if ($col != '') {
					if (isset($row[$col])) {
						unset($row[$col]);
					}
					$this->_return[$i] = $row;
				} else {
					$this->_return[$i] = array_slice($row, 1, count($row) - 1);
				}
			}
		}
		return $this;
	}
}