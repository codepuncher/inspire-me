<?php

/**
 * Inspiration Generator class
 */
class Inspirator
{
    private static $instance;

    public $data;

    protected $columns = [];
    protected $column_src_1;
    protected $column_src_2;
    protected $column_src_3;
    protected $values = [];
    public $columnCount;

    public function __construct()
    {
        $this->column_src_1 = require 'data/1.php';
        $this->column_src_2 = require 'data/2.php';
        $this->column_src_3 = require 'data/3.php';
        $this->columns  = [
            1 => $this->column_src_1,
            2 => $this->column_src_2,
            3 => $this->column_src_3,
        ];
        $this->columnCount = count($this->columns);
    }

    public static function getInstance()
    {
        if (!is_null(self::$instance)) {
            return self::$instance;
        }
        self::$instance = new self;
        return self::$instance;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function dump($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

    public function absint($maybeint)
    {
        return abs(intval($maybeint));
    }

    public function getColumnValue($column, $index)
    {
        return $this->columns[$column][$index];
    }

    public function getColumnIndex($column)
    {
        return $this->values[$column];
    }

    public function getValues()
    {
        return $this->values;
    }

    public function generate($columns)
    {
        $this->values = array_map([$this,'absint'], $columns);
        $clicked = $this->absint($_POST['generate']);
        if (0 !== $clicked && ! isset($this->columns[ $clicked ])) {
            return 'Not a valid column';
        }

        if (0 === $clicked || !$clicked) {
            $output = '';
            for ($i=1; $i <= count($this->columns); $i++) {
                $pluck_index = array_rand($this->columns[$i]);
                $this->values[$i] = $pluck_index;
                $output .= $this->getColumnValue($i, $pluck_index) . ' ';
            }
        } else {
            $pluck_index = array_rand($this->columns[$clicked]);
            $this->values[$clicked] = $pluck_index;
        }

        return $this->getInspiration($this->values);
    }

    public function getInspiration($values)
    {
        $output = '';
        for ($i=1; $i <= count($values); $i++) {
            $output .= $this->getColumnValue($i, $values[$i]) . ' ';
        }
        return trim($output);
    }

}
