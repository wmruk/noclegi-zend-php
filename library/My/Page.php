<?php

class My_Page
{
    protected $_options;

    public function __construct(array $options = null)
    {
        if ($options === null) {
            $this->_options = array();
        } else {
            $this->_options = $options;
        }

        if (!isset($this->_options['title']['separator'])) {
            $this->_options['title']['separator'] = '';
        }
        if (!isset($this->_options['title']['content'])) {
            $this->_options['title']['content'] = '';
        }
        if (!isset($this->_options['title']['defaultAttachOrder'])) {
            $this->_options['title']['defaultAttachOrder'] = 'APPEND';
        }
        if (!isset($this->_options['css'])) {
            $this->_options['css'] = array();
        }
        if (!isset($this->_options['js'])) {
            $this->_options['js'] = array();
        }
        if (!isset($this->_options['keywords'])) {
            $this->_options['keywords'] = false;
        }
        if (!isset($this->_options['description'])) {
            $this->_options['description'] = false;
        }
        if (!isset($this->_options['extension'])) {
            $this->_options['extension'] = 'phtml';
        }
    }

    public function getTitleSeparator()
    {
        return $this->_options['title']['separator'];
    }

    public function setTitleSeparator($titleSeparator)
    {
        $this->_options['title']['separator'] = $titleSeparator;
    }

    public function getTitleContent()
    {
        return $this->_options['title']['content'];
    }

    public function setTitleContent($titleContent)
    {
        $this->_options['title']['content'] = $titleContent;
    }

    public function getTitleDefaultAttachOrder()
    {
        return $this->_options['title']['defaultAttachOrder'];
    }

    public function setTitleDefaultAttachOrder($defaultAttachOrder)
    {
        $this->_options['title']['defaultAttachOrder'] = $defaultAttachOrder;
    }

    public function getCss()
    {
        return $this->_options['css'];
    }

    public function setCss($css)
    {
        $this->_options['css'] = $css;
    }

    public function getJs()
    {
        return $this->_options['js'];
    }

    public function setJs($js)
    {
        $this->_options['js'] = $js;
    }

    public function getKeywords()
    {
        return $this->_options['keywords'];
    }

    public function setKeywords($keywords)
    {
        $this->_options['keywords'] = $keywords;
    }

    public function getDescription()
    {
        return $this->_options['description'];
    }

    public function setDescription($description)
    {
        $this->_options['description'] = $description;
    }

    public function getExtension()
    {
        return $this->_options['extension'];
    }

    public function setExtension($extension)
    {
        $this->_options['extension'] = $extension;
    }

    public function getOptions()
    {
        return $this->_options;
    }

    public function setOptions($options)
    {
        $this->_options = $options;
    }

}