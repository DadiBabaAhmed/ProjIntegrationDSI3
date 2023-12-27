<?php class Template
{
    //path to  Template.php
    protected $template;
    //path passed in 
    protected $vars = array();

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function __get($key)
    {
        return $this->vars[$key];
    }
    //key is the variable name and value is the value of the variable

    public function __set($key, $value)
    {
        $this->vars[$key] = $value;

    }
    public function __toString()
    {
        extract($this->vars);
        chdir(dirname($this->template));
        ob_start();

        include basename($this->template);

        return ob_get_clean();
    }
}