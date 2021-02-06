<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class InfoPagesController extends Controller
{
    //
  public function info_list(){


    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    if ($request->has("ismodif")) {
      $params = $request->all();
      $info = Info::query()->where("idinfo",'=',$params['info_id'])->first();
      // echo $info;
      if (count($errors) == 0) {
        $info->update($params);
        $success = 'Mise a jour complet';
      }
    }

    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"info List"]
    ];
    return view('/pages/app-info-list', [
      'breadcrumbs' => $breadcrumbs,
      'errors' => $errors, 'success' => $success
    ]);
  }

  // info View Page
  public function info_view(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"info View"]
    ];
    return view('/pages/app-info-view', [
      'breadcrumbs' => $breadcrumbs
    ]);
  }

  // info Edit Page
  public function info_edit(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"info Edit"]
    ];
    return view('/pages/app-info-edit', [
      'breadcrumbs' => $breadcrumbs
    ]);
  }
}
