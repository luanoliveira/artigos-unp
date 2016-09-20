<?php

namespace App\Helper\Field;

class SelectField extends Field
{
    protected $options = [];

    protected $multiple = false;

    protected $isDefault = true;

    public function __construct($name, $label, array $options=[], $value=null)
    {
        parent::__construct($name, $label, $value);

        foreach($options as $k => $v)
        {
            $this->setOption($k, $v);
        }
    }

    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
        return $this;
    }

    public function setMultiple()
    {
        $this->multiple = true;
        return $this;
    }

    public function isMultiple()
    {
        return $this->multiple;
    }

    public function tag()
    {
        $this->setAttr('name', $this->getName().($this->isMultiple() ? '[]' : null));

        if ( $this->isMultiple() )
        {
            $this->setAttr('multiple');
        }

        $tag[] = "<select id=\"field_{$this->getName()}\" {$this->getAttrsFormated()}>";
        
        if ( $this->isDefault )
        {
            $tag[] = "<option value=\"\">#</option>";
        }

        foreach($this->options as $key => $value)
        {
            $selected = $this->isSelected($key) ? 'selected' : null;
            $tag[] = "<option value=\"{$key}\" {$selected}>{$value}</option>";
        }

        $tag[] = "</select>";

        return implode('', $tag);
    }

    public function isSelected($value)
    {
        if ( !$value )
        {
            return false;
        }

        if ( is_array($this->getValue()) )
        {
            return in_array($value, $this->getValue());
        }

        return $value == $this->getValue();
    }

}