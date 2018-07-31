<?php

/**
 * Page
 */
class Page implements JsonSerializable {

  private $location;
  private $date;
  private $category;
  private $source;
  private $image;
  private $content;
  private $title;
  private $errors;
 
  public function getLocation() {
    return $this->location;
  }

  public function setLocation($location) {
    $this->location = $location;
    return $this;
  }

  public function getDate() {
    return $this->date;
  }

  public function setDate($date) {
    $this->date = $date;
    return $this;
  }
  public function getCategory() {
    return $this->category;
  }

  public function setCategory($category) {
    $this->category = $category;
    return $this;
  }  
  
  public function getSource() {
    return $this->source;
  }

  public function setSource($source) {
    $this->source = $source;
    return $this;
  }

  public function getImage() {
    return $this->image;
  }

  public function setImage($image) {
    $this->image = $image;
    return $this;
  }

  public function getContent() {
    return $this->content;
  }


  public function setContent($content) {
    $this->content = $content;
    return $this;
  }


  public function getTitle() {
    return $this->title;
  }

  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  public function getErrors() {
    return $this->errors;
  }


  public function setErrors(array $errors) {
    $this->errors = $errors;
    return $this;
  }


  public function addError($error) {
    $this->errors[] = $error;
  }

  public static function deserialize($json) {
      $className = get_called_class();
      $classInstance = new $className();
      if (is_string($json))
          $json = json_decode($json);

      foreach ($json as $key => $value) {
          if (!property_exists($classInstance, $key)) continue;

          $classInstance->$key = $value;
      }

      return $classInstance;
  }


  function jsonSerialize() {
      return get_object_vars($this);
  }
}

 ?>
