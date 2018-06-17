<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 16.06.18
 * Time: 18:20
 */

trait utils_for_composite_key
{
    public function getMaxId()
    {
        return false;
    }

    public function exist()
    {

        foreach ($this->getPrimaryKey() as $key) {
            $value[] = $key . "='" . $this->{$key} . "'";
        }
        $resultQuery = $this->getDB()->query(strtoupper('SELECT ' . implode(",", $this->getCurrentFields()) . ' FROM ' . $this->getCurrentTableName() . ' WHERE ' . implode(' and ', $value) . ''));
        if ($resultQuery!== false) {
            if ($resultQuery->num_rows > 0){
                $result = true;
            }
            else{
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result;
    }

    public function findById($value)
    {
        return false;
    }

    public function save()
    {
        $this->prepareProperties();
        if (($this->exist() == false)) {
            //insert
            $resultQuery = $this->getDB()->query('INSERT INTO ' . $this->getCurrentTableName() . ' (' . implode(",", $this->getCurrentFields()) . ') VALUES (\'' . implode("','", $this->getCurrentValues()) . '\')');
            return $resultQuery ? $this->getDB()->insert_id : 0;
        } else {
            //update
            $value = [];
            foreach ($this->getCurrentFields() as $key) {
                $value[] = $key . "='" . $this->{$key} . "'";
            }
            foreach ($this->getPrimaryKey() as $key) {
                $pValue[] = $key . "='" . $this->{$key} . "'";
            }
            $resultQuery = $this->getDB()->query('UPDATE ' . $this->getCurrentTableName() . ' SET ' . implode(',', $value) . 'WHERE ' .implode(' and ', $pValue)  . '');
            return $resultQuery;
        }
    }

}