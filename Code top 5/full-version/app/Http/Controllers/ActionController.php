<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\action;
use App\Models\Escalade;
use App\Models\Gid;
use App\Models\Origine;
use App\Models\Pdca;
use App\Models\Sqdip;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    //
  public function action_index(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Créer une action"]
    ];
    $directions = Direction::all();
    $sqdips =Sqdip::all();
    $pdcas = Pdca::all();
    $escalades = Escalade::all();
    $gids = Gid::all();
    $origines = Origine::all();
    return view('/pages/app-action-create',[
        'breadcrumbs' => $breadcrumbs,
        'origines' => $origines,
        'directions' => $directions,
        'sqdips' => $sqdips,
        'escalades' => $escalades,
        'gids' => $gids,
        'pdcas' => $pdcas,]

    );

  }

  public function action_list(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"action"]
    ];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    $actions = Action::all();
    return view('/pages/app-action-list', [
      'breadcrumbs' => $breadcrumbs,
      "actions"=>$actions]);

  }
  public function action_create(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Create action"]
    ];
    global $title;
    $title = "action";
    $errors = [];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $actions = Action::all();
    $params = request()->toArray();
    $classes =[];
   /* $direction = Direction::query()->where("direction","=",$params["direction"])->first();
    $origine = Origine::query()->where("origine","=",$params["origine"])->first();
    $sqdip = Sqdip::query()->where("sqdip","=",$params["sqdip"])->first();*/
    if (count($params)!==0){
      if (count($errors)==0){
       /* $params["iddirection"] =$direction->iddirection;
        $params["idorigine"] =$origine->idorigine;
        $params["idsqdip"] =$sqdip->idsqdip;*/
        var_dump($params);
        $action = Action::query()->create($params);
        array_push($classes,"add_action_success add_action_error");
      }else{
        array_push($classes,"add_action_error");
      }
    }

// $action = Action::query()->create($params);
    return redirect('app-action-list')->with('success',"Enregistrement effectuer avec success");
  }

  public function action_detail($id){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Detail action"]
    ];

    $origines = Origine::all();
    $directions = Direction::all();
    $sqdips =Sqdip::all();
    $action = Action::query()->where("idaction",'=',$id)->first();
    $request = request();
    if ($request->has("ismodif")) {
      $params = $request->all();
      $action->iddirection = $params['iddirection'];
      $action->idorigine = $params['idorigine'];
      $action->idsqdip = $params['idsqdip'];
      $action->action = $params['action'];
      $action->responsable = $params['responsable'];
      $action->description = $params['description'];
      $action->direction = $params['direction'];
      $action->origine= $params['origine'];
      $action->sqdip = $params['sqdip'];
      $action->mini = $params['mini'];
      $action->valeur = $params['valeur'];
      $action->maxi = $params['maxi'];
      $action->a1 = $params['a1'];
      $action->save($params);
      return redirect('app-action-list')->with("success","Modification réussit");

    }
    return view('/pages/app-action-detail',[
        'breadcrumbs' => $breadcrumbs,
        'action' => $action,
        'origines' => $origines,
        'directions' => $directions,
        'sqdips' => $sqdips,]

    );

  }

  public function action_edit($id){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Detail action"]
    ];

    $origines = Origine::all();
    $directions = Direction::all();
    $sqdips =Sqdip::all();
    $action = Action::query()->where("idaction",'=',$id)->first();
    $request = request();

    if ($request->has("ismodif")) {
      $params = $request->all();
      $action->iddirection = $params['iddirection'];
      $action->idorigine = $params['idorigine'];
      $action->idsqdip = $params['idsqdip'];
      $action->action = $params['action'];
      $action->responsable = $params['responsable'];
      $action->description = $params['description'];
      $action->direction = $params['direction'];
      $action->origine= $params['origine'];
      $action->sqdip = $params['sqdip'];
      $action->mini = $params['mini'];
      $action->valeur = $params['valeur'];
      $action->maxi = $params['maxi'];
      $action->a1 = $params['a1'];
      $action->save($params);
      return redirect('app-action-list')->with("success","Modification réussit");

    }

    return redirect('app-action-list')->with("success","Modification réussit");
  }
//////// END action //////////////////////////
}
