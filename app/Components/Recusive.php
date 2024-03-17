<?php

namespace App\Components;

use App\Models\Category;

class Recusive
{
    private $data;
    private $htmlSelect= '';
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function categoryRecursive($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                $currentText = $text . '--';
                if (!empty($parentId) && $parentId == $value['id']) {
                    $this->htmlSelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                } else {
                    $this->htmlSelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . "</option>";
                }
                $this->categoryRecursive($parentId, $value['id'], $currentText);
            }
        }
        return $this->htmlSelect;
    }    

}
