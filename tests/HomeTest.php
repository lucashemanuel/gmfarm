<?php 

namespace Tests;

use App\Controller\Pages\Home;
use App\Model\Entity\Organization;
use App\Utils\View;
use PHPUnit\Framework\TestCase;

class HomeTest extends TestCase { 
  
  public function testIfHomePageIsEmpty() {
    $home =  new Home;
    
    $this -> assertEmpty($home -> getHome());
  }
  
  public function testIfHomePageIsNotEmpty() {
    $home =  new Home;
    
    $this -> assertNotEmpty($home -> getHome());
  }

  public function testIfOrganizationIsEmpty() {
    $obOrganization = new Organization;
    $obOrganization::$id = 0;
    $this -> assertEmpty($obOrganization);
  }
  
  public function testIfOrganizationIsNotEmpty() {
    $obOrganization = new Organization;
    $obOrganization::$id = 0;
    $this -> assertNotEmpty($obOrganization);
  }
  
  public function testIfContentIsEmpty() {
    $obOrganization = new Organization;
    $content = View::render('pages/home', ['welcome' => $obOrganization->welcome,'description' => $obOrganization->description]);    
    $this -> assertFileExists($content);
  }

  public function testIfContentIsNotEmpty() {
    $obOrganization = new Organization;
    $content = View::render('pages/home', ['welcome' => $obOrganization->welcome,'description' => $obOrganization->description]);    
    $this -> assertFileDoesNotExist($content);
  }
  
}