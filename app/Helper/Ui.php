<?php

namespace App\Helper;

class Ui
{
    protected $title;

    protected $subTitle;

    protected $pageActions = [];

    protected $menu = [];
    protected $menuActive;

    protected $form;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTitlePage($prefix='UNP')
    {
        return $this->getTitle() ? $prefix.' | '.$this->getTitle() : $prefix;
    }

    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;
    }

    public function getSubTitle()
    {
        return $this->subTitle;
    }

    public function setPageAction($name, $link, array $attrs=[])
    {
        $this->pageActions[] = [
            'name' => $name,
            'link' => $link,
            'attrs' => $attrs
        ];

        return $this;
    }

    public function getPageActions()
    {
        return $this->pageActions;
    }

    public function addMenu($id, $name, $link='#')
    {
        $this->menu[$id] = [
            'name' => $name,
            'link' => $link
        ];

        return $this;
    }

    public function setMenuActive($id)
    {
        if ( array_key_exists($id, $this->menu) )
        {
            $this->menuActive = $id;
        }
    }

    public function getMenuActive()
    {
        return $this->menuActive;
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function isMenu()
    {
        return !empty($this->menu);
    }

    public function input($name, $data=null)
    {
        if ( old($name) )
        {
            return old($name);
        }

        if ( isset($data->$name) )
        {
            return $data->$name;
        }
    }

    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function isForm()
    {
        return $this->getForm() ? true : false;
    }
}