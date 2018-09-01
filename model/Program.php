<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/22/2017
 */
class Program
{
    private $_id;
    private $_title;
    private $_sub_title;
    private $_desc_head;
    private $_desc_body;
    private $_desc_list_head;
    private $_desc_list_data = array();
    private $_desc_footer_head;
    private $_desc_footer_body;
    private $_info_head;
    private $_info_body;
    private $_info_list_head;
    private $_info_list_data = array();
    private $_info_footer_head;
    private $_info_footer_body;
    private $_footer_head;
    private $_footer_body;
    private $_footer_list_head;
    private $_footer_list_data = array();
    private $_contacts = array();
    private $_img_path;
    private $_link;
    private $_link_text;
    private $_active;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return mixed
     */
    public function getSubTitle()
    {
        return $this->_sub_title;
    }

    /**
     * @param mixed $sub_title
     */
    public function setSubTitle($sub_title)
    {
        $this->_sub_title = $sub_title;
    }

    /**
     * @return mixed
     */
    public function getDescHead()
    {
        return $this->_desc_head;
    }

    /**
     * @param mixed $desc_head
     */
    public function setDescHead($desc_head)
    {
        $this->_desc_head = $desc_head;
    }

    /**
     * @return mixed
     */
    public function getDescBody()
    {
        return $this->_desc_body;
    }

    /**
     * @param mixed $desc_body
     */
    public function setDescBody($desc_body)
    {
        $this->_desc_body = $desc_body;
    }

    /**
     * @return mixed
     */
    public function getDescListHead()
    {
        return $this->_desc_list_head;
    }

    /**
     * @param mixed $desc_list_head
     */
    public function setDescListHead($desc_list_head)
    {
        if($desc_list_head != '')
        {
            $this->_desc_list_head = $desc_list_head;
        }
    }

    /**
     * @return mixed
     */
    public function getDescListData()
    {
        return $this->_desc_list_data;
    }

    /**
     * @param mixed $desc_list_data
     */
    public function setDescListData($desc_list_data)
    {
        $desc_list_data = $this->removeLeadingTilde($desc_list_data);

        if(strpos($desc_list_data, '~'))
        {
            $this->_desc_list_data = explode("~", $desc_list_data);
        }
        else
        {
            if($desc_list_data != '' && $desc_list_data != null)
            {
                array_push($this->_desc_list_data, $desc_list_data);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getDescFooterHead()
    {
        return $this->_desc_footer_head;
    }

    /**
     * @param mixed $desc_footer_head
     */
    public function setDescFooterHead($desc_footer_head)
    {
        $this->_desc_footer_head = $desc_footer_head;
    }

    /**
     * @return mixed
     */
    public function getDescFooterBody()
    {
        return $this->_desc_footer_body;
    }

    /**
     * @param mixed $desc_footer_body
     */
    public function setDescFooterBody($desc_footer_body)
    {
        $this->_desc_footer_body = $desc_footer_body;
    }

    /**
     * @return mixed
     */
    public function getInfoHead()
    {
        return $this->_info_head;
    }

    /**
     * @param mixed $info_head
     */
    public function setInfoHead($info_head)
    {
        $this->_info_head = $info_head;
    }

    /**
     * @return mixed
     */
    public function getInfoBody()
    {
        return $this->_info_body;
    }

    /**
     * @param mixed $info_body
     */
    public function setInfoBody($info_body)
    {
        $this->_info_body = $info_body;
    }

    /**
     * @return mixed
     */
    public function getInfoListHead()
    {
        return $this->_info_list_head;
    }

    /**
     * @param mixed $info_list_head
     */
    public function setInfoListHead($info_list_head)
    {
        $this->_info_list_head = $info_list_head;
    }

    /**
     * @return mixed
     */
    public function getInfoListData()
    {
        return $this->_info_list_data;
    }

    /**
     * @param mixed $info_list_data
     */
    public function setInfoListData($info_list_data)
    {
        $info_list_data = $this->removeLeadingTilde($info_list_data);

        if(strpos($info_list_data, '~'))
        {
            $this->_info_list_data = explode("~", $info_list_data);
        }
        else
        {
            if($info_list_data != '' && $info_list_data != null)
            {
                array_push($this->_info_list_data, $info_list_data);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getInfoFooterHead()
    {
        return $this->_info_footer_head;
    }

    /**
     * @param mixed $info_footer_head
     */
    public function setInfoFooterHead($info_footer_head)
    {
        $this->_info_footer_head = $info_footer_head;
    }

    /**
     * @return mixed
     */
    public function getInfoFooterBody()
    {
        return $this->_info_footer_body;
    }

    /**
     * @param mixed $info_footer_body
     */
    public function setInfoFooterBody($info_footer_body)
    {
        $this->_info_footer_body = $info_footer_body;
    }

    /**
     * @return mixed
     */
    public function getFooterHead()
    {
        return $this->_footer_head;
    }

    /**
     * @param mixed $footer_head
     */
    public function setFooterHead($footer_head)
    {
        $this->_footer_head = $footer_head;
    }

    /**
     * @return mixed
     */
    public function getFooterBody()
    {
        return $this->_footer_body;
    }

    /**
     * @param mixed $footer_body
     */
    public function setFooterBody($footer_body)
    {
        $this->_footer_body = $footer_body;
    }

    /**
     * @return mixed
     */
    public function getFooterListHead()
    {
        return $this->_footer_list_head;
    }

    /**
     * @param mixed $footer_list_head
     */
    public function setFooterListHead($footer_list_head)
    {
        $this->_footer_list_head = $footer_list_head;
    }

    /**
     * @return mixed
     */
    public function getFooterListData()
    {
        return $this->_footer_list_data;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->_active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->_active = $active;
    }

    /**
     * @param mixed $footer_list_data
     */
    public function setFooterListData($footer_list_data)
    {
        $footer_list_data = $this->removeLeadingTilde($footer_list_data);

        if(strpos($footer_list_data, '~'))
        {
            $this->_footer_list_data = explode('~', $footer_list_data);
        }
        else
        {
            if($footer_list_data != '' && $footer_list_data != null)
            {
                array_push($this->_footer_list_data, $footer_list_data);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getImgPath()
    {
        return $this->_img_path;
    }

    /**
     * @param mixed $img_path
     */
    public function setImgPath($img_path)
    {
        if($img_path != '')
        {
            $this->_img_path = $img_path;
        }
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->_link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        if($link != '')
        {
            $this->_link = $link;
        }
    }

    /**
     * @return array
     */
    public function getContacts()
    {
        return $this->_contacts;
    }

    public function addContact($contact)
    {
        if($contact)
        {
            array_push($this->_contacts, $contact);
        }
    }

    /**
     * @return mixed
     */
    public function getLinkText()
    {
        return $this->_link_text;
    }

    /**
     * @param mixed $link_text
     */
    public function setLinkText($link_text)
    {
        $this->_link_text = $link_text;
    }

    private function removeLeadingTilde($string)
    {
        if(substr($string, 0 , 1) == "~")
        {
            ltrim($string, "~");
        }
        return $string;
    }
}