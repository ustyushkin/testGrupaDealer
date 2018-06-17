<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 15.06.18
 * Time: 18:17
 */

trait utils
{
    public function getCurrentTableName()
    {
        return strtoupper(get_class($this));
    }

    public function getCurrentFields()
    {
        return array_keys(get_class_vars($this->getCurrentTableName()));
    }

    public function getCurrentValues()
    {
        $value = [];
        foreach ($this->getCurrentFields() as $key) {
            $value[] = $this->{$key};
        }
        return $value;
    }

    public function getCurrentFieldsWithoutPrimaryKey()
    {
        $value = get_class_vars($this->getCurrentTableName());
        return array_keys(array_diff_key($value, array($this->getPrimaryKey() => '')));
    }

    public function getCurrentValuesWithoutPrimaryKey()
    {
        $value = [];
        foreach ($this->getCurrentFields() as $key) {
            if ($key <> $this->getPrimaryKey()) {
                $value[] = $this->{$key};
            }
        }
        return $value;
    }

    private function prepareProperties()
    {
        foreach ($this->getCurrentFields() as $key) {
            $this->{$key} = strip_tags($this->{$key});
            $this->{$key} = htmlentities($this->{$key}, ENT_QUOTES, "UTF-8");
            $this->{$key} = htmlspecialchars($this->{$key}, ENT_QUOTES);
        }
    }

    private function prepValue($value)
    {
        $value = strip_tags($value);
        $value = htmlentities($value, ENT_QUOTES, "UTF-8");
        $value = htmlspecialchars($value, ENT_QUOTES);
        return $value;
    }

    public function getMaxId()
    {
        $this->prepareProperties();
        $resultQuery = $this->getDB()->query(strtoupper('SELECT max(' . $this->getPrimaryKey() . ') as count FROM ' . $this->getCurrentTableName()));
        return $resultQuery->fetch_array(MYSQLI_ASSOC)["COUNT"];
    }

    public function getCount()
    {
        $resultQuery = $this->getDB()->query(strtoupper('SELECT COUNT(*) as count FROM ' . $this->getCurrentTableName()));
        return $resultQuery->fetch_array(MYSQLI_ASSOC)["COUNT"];
    }

    public function find($field, $value)
    {
        $resultQuery = $this->getDB()->query(strtoupper('SELECT ' . implode(",", $this->getCurrentFields()) . ' FROM ' . $this->getCurrentTableName() . ' where ' . $this->prepValue($field) . '=\'' . $this->prepValue($value) . '\''));
        if ($resultQuery->num_rows > 0) {
            /*$row = $resultQuery->fetch_array(MYSQLI_ASSOC);
            foreach ($this->getCurrentFields() as $key) {
                $this->$key = $row[$key];
            }*/
            $result = $resultQuery;
        } else {
            $result = false;
        }
        return $result;
    }

    public function exist($value)
    {
        $resultQuery = $this->getDB()->query(strtoupper('SELECT ' . implode(",", $this->getCurrentFields()) . ' FROM ' . $this->getCurrentTableName() . ' WHERE ' . $this->getPrimaryKey() . '=\'' . $this->prepValue($value) . '\''));
        if ($resultQuery->num_rows > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function findById($value)
    {
        $resultQuery = $this->getDB()->query(strtoupper('SELECT ' . implode(",", $this->getCurrentFields()) . ' FROM ' . $this->getCurrentTableName() . ' WHERE ' . $this->getPrimaryKey() . '=\'' . $this->prepValue($value) . '\''));
        if ($resultQuery->num_rows > 0) {
            $row = $resultQuery->fetch_array(MYSQLI_ASSOC);
            foreach ($this->getCurrentFields() as $key) {
                $this->$key = $row[$key];
            }
            $resultQuery->free();
            $result = $row;
        } else {
            $result = false;
        }
        return $result;
    }

    public function save()
    {
        $this->prepareProperties();
        if (($this->exist($this->{$this->getPrimaryKey()}) == false) || ($this->{$this->getPrimaryKey()} == '')) {
            //insert
            $resultQuery = $this->getDB()->query('INSERT INTO ' . $this->getCurrentTableName() . ' (' . implode(",", $this->getCurrentFieldsWithoutPrimaryKey()) . ') VALUES (\'' . implode("','", $this->getCurrentValuesWithoutPrimaryKey()) . '\')');
            return $resultQuery ? $this->getDB()->insert_id : 0;
        } else {
            //update
            $value = [];
            foreach ($this->getCurrentFields() as $key) {
                $value[] = $key . "='" . $this->{$key} . "'";
            }
            $resultQuery = $this->getDB()->query('UPDATE ' . $this->getCurrentTableName() . ' SET ' . implode(',', $value) . 'WHERE ' . $this->getPrimaryKey() . '=\'' . $this->{$this->getPrimaryKey()} . '\'');
            return $resultQuery;
        }
    }

    public function selectAll()
    {
        $resultQuery = $this->getDB()->query(strtoupper('SELECT ' . implode(",", $this->getCurrentFields()) . ' FROM ' . $this->getCurrentTableName()));
        if ($resultQuery->num_rows == 0) {
            return false;
        } else {
            return $resultQuery;
        }
    }

    public function limit($limit, $offset)
    {
        $sql = 'SELECT ' . implode(",", $this->getCurrentFields()) . ' FROM ' . $this->getCurrentTableName();

        $limit = $offset + $limit;
        $newsql = "SELECT * FROM (select inner_query.*, rownum rnum FROM ($sql) inner_query WHERE rownum < $limit)";

        if ($offset != 0) {
            $newsql .= " WHERE rnum >= $offset";
        }

        $resultQuery = $this->getDB()->query(strtoupper($newsql));

        if ($resultQuery->num_rows() == 0) {
            return false;
        } else {
            return $resultQuery;
        }
    }
}