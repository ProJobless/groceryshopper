<?php

use Robbo\Presenter\Presenter;

class ProductPresenter extends Presenter
{
   public function url()
   {
       return $this->id.'-'.$this->username;
   }

}
