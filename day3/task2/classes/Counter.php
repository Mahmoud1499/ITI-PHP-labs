<?php

class Counter
{
    private $_count;


    public function __construct()
    {
        $this->_count = $this->get_count();
    }
    public function get_count()
    {
        if (file_exists(COUNTER_FILE)) {
            return intval(file_get_contents(COUNTER_FILE));
        } else {
            return 0;
        }
    }
    public function increment()
    {
        if (!isset($_SESSION[SESSION_KEY_COUNTER])) {

            $this->_count++;
            $_SESSION[SESSION_KEY_COUNTER] = true;
            return $this->_count;
        } else {
            return false;
        }
    }

    public function update_counter()
    {
        $fp = fopen(COUNTER_FILE, "w+");
        fwrite($fp, $this->_count);
        fclose($fp);
    }
    public function increment_and_update()
    {
        if ($this->increment() != false)
            $this->update_counter();
    }
}
