<?php 
namespace Tests;

use App\Controller\Pages\Page;
use PHPUnit\Framework\TestCase;
use \App\Http\Request;
use \WilliamCosta\DatabaseManager\Pagination;


class PageTest extends TestCase {

  public function testIfPageExists() {
    $page = new Page;        
  }
  
  public function testIfPageNotExists() {
    $page = new Page;
  }

}