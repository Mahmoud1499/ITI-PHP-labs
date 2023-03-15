<?php

class RangeFilter implements filter_interface
{
    private $_column, $_min, $_max;
    public function __construct($_column, $_min, $_max)
    {
        $this->_column = $_column;
        $this->_min = $_min;
        $this->_max = $_max;
    }
    public function get_sql()
    {
        return "'" . $this->_column . "' > '" . $this->_min . "'and'" . $this->_max;
    }
}
