<?php
/*
Plugin Name: asequentialart rich-webcomic page manager
Description: A plugin made for creating and managing webcomic pages with complex html structures for special comic features.
Version:0.0.0.1
Author: Carlos Ruiz
Author URI: https://asequentialart.com
Copyright 2026 Carlos Ruiz 

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/ 
namespace Classes;
if (! defined('ABSPATH')){
    exit;
}

if (file_exists(__DIR__.'/vendor/autoload.php')){
    require_once __DIR__.'/vendor/autoload.php';
}
use Classes\Factory;

$init=Factory::init();
$init->entrypoint();





