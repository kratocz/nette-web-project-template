<?php

namespace App\Repositories;

use App\Helpers\ApiHelpers;
use Nette\Database\Table\ActiveRow;
use Nette\Utils\ArrayHash;

/**
 * @property-read string $tableName
 * @property-read \Nette\Database\Table\Selection $table
 * @property-read string $defaultOrder
 * @property-read array $defaultWhere
 */
abstract class BaseDatabaseRepository
{

	use \Nette\SmartObject;

	/** @var string */
	protected $tableName;

	/** @var \Nette\Database\Context */
	protected $context;

	public function __construct(string $tableName, \Nette\Database\Context $context)
	{
		$this->tableName = $tableName;
		$this->context = $context;
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	/**
	 * @return \Nette\Database\Table\Selection
	 */
	public function getTable()
	{
		return $this->context->table($this->tableName);
	}

	/**
	 * Insert new row
	 * @param array $values
	 * @return \Nette\Database\Table\IRow the new row
	 */
	public function insert(array $values)
	{
		return $this->table->insert($values);
	}

	public function getColumnsInfo()
	{
		return $this->context->query('SHOW COLUMNS FROM ' . $this->tableName);
	}

	/**
	 * Update existing row
	 * @param array $values
	 * @return int number of affected rows
	 */
	public function update(array $values)
	{
		return $this->findById($values['id'])->update($values);
	}

	/**
	 * Delete existing row
	 * @param \Nette\Database\Table\IRow|int $id
	 * @return int number of affected rows
	 */
	public function delete($id)
	{
		if ($id instanceof \Nette\Database\Table\IRow)
		{
			$id = $id->id;
		}
		return $this->findById($id)->delete();
	}

	abstract public function getDefaultWhere();

	abstract public function getDefaultOrder();

	/**
	 *
	 * @param int $primaryKeyId
	 * @param int $webuserId
	 * @param array $where
	 * @param string $order
	 * @return \Nette\Database\Table\Selection
	 */
	public function find($primaryKeyId = NULL, $where = [], $order = NULL)
	{
		$defaultWhere = $this->defaultWhere;
		if ($where !== NULL)
		{
			$where = array_merge($defaultWhere, $where);
		}
		else
		{
			$where = $this->defaultWhere;
		}

		if ($order === NULL)
		{
			$order = $this->defaultOrder;
		}

		$sel = $this->getTable();
		if ($primaryKeyId !== NULL)
		{
			$sel->wherePrimary($primaryKeyId);
		}
		if ($where !== NULL)
		{
			$sel->where($where);
		}
		if ($order !== NULL)
		{
			$sel->order($order);
		}
		return $sel;
	}

	public function beginTransaction()
	{
		$this->context->beginTransaction();
	}

	public function commit()
	{
		$this->context->commit();
	}

	public function toObjectList(array $rows): array {
		$result = [];
		foreach ($rows as $row) {
			$result[] = $this->toObject($row);
		}
		return $result;
	}

	public function toObject(ActiveRow $row): ArrayHash {
		// return (object) $row->toArray();
		$obj = new ArrayHash();
		foreach ($row->toArray() as $key => $value) {
			$key = ApiHelpers::convertKey($key);
			$obj[$key] = $value;
		}
		return $obj;
	}

}
