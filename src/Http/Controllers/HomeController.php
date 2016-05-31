<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 31/05/16
 * Time: 10:15
 */

namespace Anavel\Test\Http\Controllers;


use Anavel\Foundation\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view("anavel-test::pages.index");
    }

}