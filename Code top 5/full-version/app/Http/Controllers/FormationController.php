<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormationController extends Controller
{
  // Formation list
  public function formation_list(){
    $pageConfigs = [
      'contentLayout' => "content-detached-left-sidebar",
      'bodyClass' => 'ecommerce-application',
    ];

    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Formation"], ['name'=>"List"]
    ];

    return view('/pages/formation-list', [
      'pageConfigs' => $pageConfigs,
      'breadcrumbs' => $breadcrumbs
    ]);
  }

  // formation Details
  public function formation_details(){
    $pageConfigs = [
      'bodyClass' => 'ecommerce-application',
    ];

    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Formation"], ['name'=>"Product Details"]
    ];

    return view('/pages/formation-details', [
      'pageConfigs' => $pageConfigs,
      'breadcrumbs' => $breadcrumbs
    ]);
  }

  // formation Wish List
  public function formation_wishlist(){
    $pageConfigs = [
      'bodyClass' => 'ecommerce-application',
    ];

    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Formation"], ['name'=>"Wish List"]
    ];

    return view('/pages/formation-wishlist', [
      'pageConfigs' => $pageConfigs,
      'breadcrumbs' => $breadcrumbs
    ]);
  }

  // formation Checkout
  public function formation_checkout(){
    $pageConfigs = [
      'bodyClass' => 'ecommerce-application',
    ];

    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Formation"], ['name'=>"Checkout"]
    ];

    return view('/pages/formation-checkout', [
      'pageConfigs' => $pageConfigs,
      'breadcrumbs' => $breadcrumbs
    ]);
  }
}
