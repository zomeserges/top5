<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Indicateur;
use App\Models\Origine;
use App\Models\Sqdip;
use Illuminate\Http\Request;

class IndicateurController extends Controller
{
    //
  //////// START indicateur //////////////////////////

  public function indicateur_index(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Créer un indicateur"]
    ];

  $origines = Origine::all();
  $directions = Direction::all();
  $sqdips =Sqdip::all();
    return view('/pages/app-indicateur-create',[
        'breadcrumbs' => $breadcrumbs,
        'origines' => $origines,
        'directions' => $directions,
        'sqdips' => $sqdips,]

    );

  }

  public function indicateur_list(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"indicateur"]
    ];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    $indicateus = Indicateur::all();
   /* if ($request->has("ismodif")) {
      $params = $request->all();
      $indicateur = Indicateur::query()->where("idindicateur", '=', $params['edit_indicateur_id'])->first();
      $indicateur->indicateur = $params['edit_indicateur_name'];
      $indicateur->save($params);
    }*/

    return view('/pages/app-indicateur-list', [
      'breadcrumbs' => $breadcrumbs,
      "indicateurs"=>$indicateus]);

  }
  public function indicateur_create(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Create indicateur"]
    ];
    global $title;
    $title = "indicateur";
    $errors = [];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $indicateurs = Indicateur::all();
    $params = request()->toArray();
    $classes =[];
    $direction = Direction::query()->where("direction","=",$params["direction"])->first();
    $origine = Origine::query()->where("origine","=",$params["origine"])->first();
    $sqdip = Sqdip::query()->where("sqdip","=",$params["sqdip"])->first();
    if (count($params)!==0){
      foreach ($indicateurs as $indicateur){
        if($indicateur->derection == $params["indicateur"]){
          array_push($errors, "La indicateur existe deja");
        }
      }
      if (count($errors)==0){
        $params["iddirection"] =$direction->iddirection;
        $params["idorigine"] =$origine->idorigine;
        $params["idsqdip"] =$sqdip->idsqdip;
        var_dump($params);
        $indicateur = Indicateur::query()->create($params);
        array_push($classes,"add_indicateur_success add_indicateur_error");
      }else{
        array_push($classes,"add_indicateur_error");
      }
    }

// $indicateur = Indicateur::query()->create($params);
    return redirect('app-indicateur-list')->with('success',"Enregistrement effectuer avec success");
  }

  public function indicateur_detail($id){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Detail Indicateur"]
    ];

    $origines = Origine::all();
    $directions = Direction::all();
    $sqdips =Sqdip::all();
    $indicateur = Indicateur::query()->where("idindicateur",'=',$id)->first();
    $request = request();
    if ($request->has("ismodif")) {
      $params = $request->all();
      $indicateur->iddirection = $params['iddirection'];
      $indicateur->idorigine = $params['idorigine'];
      $indicateur->idsqdip = $params['idsqdip'];
      $indicateur->indicateur = $params['indicateur'];
      $indicateur->responsable = $params['responsable'];
      $indicateur->description = $params['description'];
      $indicateur->direction = $params['direction'];
      $indicateur->origine= $params['origine'];
      $indicateur->sqdip = $params['sqdip'];
      $indicateur->mini = $params['mini'];
      $indicateur->valeur = $params['valeur'];
      $indicateur->maxi = $params['maxi'];
      $indicateur->a1 = $params['a1'];
      $indicateur->save($params);
      return redirect('app-indicateur-list')->with("success","Modification réussit");

    }
    return view('/pages/app-indicateur-detail',[
        'breadcrumbs' => $breadcrumbs,
        'indicateur' => $indicateur,
        'origines' => $origines,
        'directions' => $directions,
        'sqdips' => $sqdips,]

    );

  }

  public function indicateur_edit($id){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Detail Indicateur"]
    ];

    $origines = Origine::all();
    $directions = Direction::all();
    $sqdips =Sqdip::all();
    $indicateur = Indicateur::query()->where("idindicateur",'=',$id)->first();
    $request = request();

    if ($request->has("ismodif")) {
      $params = $request->all();
      $indicateur->iddirection = $params['iddirection'];
      $indicateur->idorigine = $params['idorigine'];
      $indicateur->idsqdip = $params['idsqdip'];
      $indicateur->indicateur = $params['indicateur'];
      $indicateur->responsable = $params['responsable'];
      $indicateur->description = $params['description'];
      $indicateur->direction = $params['direction'];
      $indicateur->origine= $params['origine'];
      $indicateur->sqdip = $params['sqdip'];
      $indicateur->mini = $params['mini'];
      $indicateur->valeur = $params['valeur'];
      $indicateur->maxi = $params['maxi'];
      $indicateur->a1 = $params['a1'];
      $indicateur->save($params);
      return redirect('app-indicateur-list')->with("success","Modification réussit");

    }

    return redirect('app-indicateur-list')->with("success","Modification réussit");
  }
//////// END indicateur //////////////////////////
}
