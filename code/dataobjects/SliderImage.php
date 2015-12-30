<?php

class BlockImage extends Image {

  static $db = array(
    'DisplayTitle' => 'Varchar(255)',
    'Caption' => 'Text'
  );

  public function getCMSFields() {
    $fields = parent::getCMSFields();
    $fields->removeByName("Title");
    $fields->removeByName("OwnerID");
    $fields->removeByName("Name");
    $fields->removeByName("FilePreview");
    $fields->removeByName("ParentID");
    $fields->tab("Main")
      ->text("DisplayTitle")
      ->textarea("Caption");
    return $fields;
  }

}
