<?php

namespace App\Http\Controllers;

use App\Models\CausePareto;
use App\Models\Direction;
use App\Models\Escalade;
use App\Models\Gid;
use App\Models\Origine;
use App\Models\Pdca;
use App\Models\Sqdip;
use App\Models\User;
use Illuminate\Http\Request;

class UserPagesController extends Controller
{
  public function editUseAccount($id){

    //return view('app-user-list', ['errors' => $errors, 'success' => $success, 'user' => $user]);

  }

    // User List Page
    public function user_list(){

      if (!userLoggedIn()) {
        redirect('/');
      }
      $title = "Mettre a jour mes informations";
      $request = request();
      $errors = [];
      $success = '';
      if ($request->has("ismodif")) {
        $params = $request->all();
        $user = User::query()->where("user_id",'=',$params['user_id'])->first();
       // echo $user;
        if ((!empty($params['password']) || !empty($params['password2'])) && $params['password'] != $params['password2']) {
          array_push($errors, "Les deux mots de passes ne sont pas identiques");
        }
        $users_with_same_mail = User::query()->where(['email' => $params['email']]);
        if ($users_with_same_mail->count() > 0) {
          $users_with_same_mail = $users_with_same_mail->first();
          if ($users_with_same_mail->user_id != $user->user_id) {
            array_push($errors, "L'adresse mail est deja utilisee");
          }
        }
        $users_with_same_phone = User::query()->where(['telephone' => $params['telephone']]);
        if ($users_with_same_phone->count() > 0) {
          $users_with_same_phone = $users_with_same_phone->first();
          if ($users_with_same_phone->user_id != $user->user_id) {
            array_push($errors, "Le numero de tel est deja utilise");
          }
        }
        $mail_changed = $params['email'] ;//!= $user->email;
        if (count($errors) == 0) {
          unset($params['password2']);
          $params['password'] = sha1($params['password']);
          $user->update($params);
          $success = 'Mise a jour complet';
          if ($mail_changed) {
            //$user->email_verified = false;
            $user->save();
            // generateVerToken();
            return redirect("/app-user-list");
          }
        }
      }

      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"User List"]
      ];
      return view('/pages/app-user-list', [
          'breadcrumbs' => $breadcrumbs,
        'errors' => $errors, 'success' => $success
      ]);
    }

    // User View Page
    public function user_view(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"User View"]
      ];
      return view('/pages/app-user-view', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }

    // User Edit Page
    public function user_edit(){
      $breadcrumbs = [
          ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"User Edit"]
      ];
      return view('/pages/app-user-edit', [
          'breadcrumbs' => $breadcrumbs
      ]);
    }





  //////// START DIRECTION //////////////////////////
  ///

  public function direction_index(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Direction"]
    ];

    return view('/pages/app-direction-create', [
      'breadcrumbs' => $breadcrumbs]);

  }

  public function direction_list(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Direction"]
    ];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    if ($request->has("ismodif")) {
      $params = $request->all();
      $direction = Direction::query()->where("iddirection", '=', $params['edit_direction_id'])->first();
      $direction->direction = $params['edit_direction_name'];
      $direction->save($params);

      //return redirect("/app-direction-list");
    }

    return view('/pages/app-direction-list', [
      'breadcrumbs' => $breadcrumbs]);

  }
  public function direction_create(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Create Direction"]
    ];
    global $title;
    $title = "Direction";
    $errors = [];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $directions = Direction::all();
    $params = request()->toArray();
    $classes =[];
    if (count($params)!==0){
      foreach ($directions as $direction){
        if($direction->derection == $params["direction"]){
          array_push($errors, "La direction existe deja");
        }
      }
      if (count($errors)==0){
        $direction = Direction::query()->create($params);
        array_push($classes,"add_direction_success add_direction_error");
      }else{
        array_push($classes,"add_direction_error");
      }
    }

    // $direction = Direction::query()->create($params);
    return redirect('app-direction-list')->with('success',"Enregistrement effectuer avec success");
  }

  //////// END DIRECTION //////////////////////////



  //////// START sqdip //////////////////////////
  ///

  public function sqdip_index(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"SQDIP"]
    ];

    return view('/pages/app-sqdip-create', [
      'breadcrumbs' => $breadcrumbs]);

  }

  public function sqdip_list(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"SQDIP"]
    ];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    if ($request->has("ismodif")) {
      $params = $request->all();
      $sqdip = Sqdip::query()->where("idsqdip", '=', $params['edit_sqdip_id'])->first();

      $sqdip->sqdip = $params['edit_sqdip_name'];
      $sqdip->save($params);

    }

    return view('/pages/app-sqdip-list', [
      'breadcrumbs' => $breadcrumbs]);

  }
  public function sqdip_create(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Create SQDIP"]
    ];
    global $title;
    $title = "sqdip";
    $errors = [];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $sqdips = Sqdip::all();
    $params = request()->toArray();
    $classes =[];
    if (count($params)!==0){
      foreach ($sqdips as $sqdip){
        if($sqdip->derection == $params["sqdip"]){
          array_push($errors, "La sqdip existe deja");
        }
      }
      if (count($errors)==0){
        $sqdip = Sqdip::query()->create($params);
        array_push($classes,"add_sqdip_success add_sqdip_error");
      }else{
        array_push($classes,"add_sqdip_error");
      }
    }

    return redirect('app-sqdip-list')->with('success',"Enregistrement effectuer avec success");
  }

//////// END sqdip //////////////////////////
///
///


//////// START escalade //////////////////////////
  public function escalade_list(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"escalade"]
    ];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    if ($request->has("ismodif")) {
      $params = $request->all();
      $escalade = Escalade::query()->where("idescalade", '=', $params['edit_escalade_id'])->first();
     // echo $escalade;
//  echo $params;
      $escalade->escalade = $params['edit_escalade_name'];
      $escalade->save($params);
      //echo $escalade;
//echo $params;
//return redirect("/app-escalade-list");
    }

    return view('/pages/app-escalade-list', [
      'breadcrumbs' => $breadcrumbs]);

  }
  public function escalade_create(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Create escalade"]
    ];
    global $title;
    $title = "escalade";
    $errors = [];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $escalades = Escalade::all();
    $params = request()->toArray();
    $classes =[];
    if (count($params)!==0){
      foreach ($escalades as $escalade){
        if($escalade->derection == $params["escalade"]){
          array_push($errors, "La escalade existe deja");
        }
      }
      if (count($errors)==0){
        $escalade = Escalade::query()->create($params);
        array_push($classes,"add_escalade_success add_escalade_error");
      }else{
        array_push($classes,"add_escalade_error");
      }
    }

// $escalade = Escalade::query()->create($params);
    return redirect('app-escalade-list')->with('success',"Enregistrement effectuer avec success");
  }

//////// END escalade //////////////////////////




//////// START pdca //////////////////////////
  public function pdca_list(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"pdca"]
    ];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    if ($request->has("ismodif")) {
      $params = $request->all();
      $pdca = PDCA::query()->where("idpdca", '=', $params['edit_pdca_id'])->first();
      //echo $pdca;
//  echo $params;
      $pdca->etat = $params['edit_pdca_name'];
      $pdca->save($params);
      //echo $pdca;
//echo $params;
//return redirect("/app-pdca-list");
    }

    return view('/pages/app-pdca-list', [
      'breadcrumbs' => $breadcrumbs]);

  }
  public function pdca_create(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Create pdca"]
    ];
    global $title;
    $title = "pdca";
    $errors = [];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $pdcas = PDCA::all();
    $params = request()->toArray();
    $classes =[];

        $pdca = PDCA::query()->create($params);
        array_push($classes,"add_pdca_success add_pdca_error");

      var_dump($params);

// $pdca = PDCA::query()->create($params);
    return redirect('/app-pdca-list')->with('success',"Enregistrement effectuer avec success");
  }

//////// END pdca //////////////////////////
///
///

//////// START gid //////////////////////////
///
///
///

  public function gid_index(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"GID"]
    ];

    $origines = Origine::all();
    $directions = Direction::all();
    //$origines =$directions;
    return view('/pages/app-gid-create',[
      'breadcrumbs' => $breadcrumbs,
      'origines'=>$origines,
      'directions'=>$directions]);

  }
  public function register()
  {
    $pageConfigs = [
      'bodyClass' => "bg-full-screen-image",
      'blankPage' => true
    ];
    /* if (userLoggedIn()) {
         return redirect('/page-user-profile');
     }*/
    global $title;
    //$title = "Inscription";


    $errors = [];
    if (!empty(request('password_ver'))) {
//        "first_name", "last_name", "email", "telephone", "password", "email_verified", "created_at", "updated_at", "type"
      $params = request()->toArray();
      // $params['email_verified'] = 0;
      //$params['type'] = 0;
      $origine = Origine::query()->where('origine','=',$params['origine'])->first();
      if ($params['password'] != $params['password_ver']) {
        array_push($errors, "Les mots de passe ne correspondent pas");
      } else if (Gid::query()->where(['email' => $params['email']])->count() > 0) {
        array_push($errors, "Cette adresse est deja utilisee");
     /* } else if (Gid::query()->where(['telephone' => $params['telephone']])->count() > 0) {
        array_push($errors, "Ce numero de telephone est deja utilise");*/
      } else {
        $params['password'] = sha1($params['password']);
        $params['idorigine']=$origine->idorigine;
       // echo $params;
       $gid = Gid::query()->create($params);
       // log_user_in($user->user_id);
        return redirect('page-gid-list');
      }
    }

    return view('pages/auth-register', [
      'pageConfigs' => $pageConfigs])->with(['errors' => $errors]);

  }


  public function gid_list(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"GID LIST"]
    ];

    if (!userLoggedIn()) {
      redirect('/');
    }
    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    $origines = Origine::all();
    $directions = Direction::all();

    $params = $request->all();
    echo ($request->has("ismodif"));
    if ($request->has("ismodif")) {
      $gid = Gid::query()->where("idgid",'=',$params['edit_gid_id'])->first();
      // echo $user;
      if ((!empty($params['edit_gid_pass']) || !empty($params['edit_gid_password_ver'])) && $params['edit_gid_password_ver'] != $params['edit_gid_pass']) {
        array_push($errors, "Les deux mots de passes ne sont pas identiques");
      }
      $gids_with_same_mail = Gid::query()->where(['email' => $params['edit_gid_email']]);
      if ($gids_with_same_mail->count() > 0) {
        $gids_with_same_mail = $gids_with_same_mail->first();
        if ($gids_with_same_mail->idgid != $gid->idgid) {
          array_push($errors, "L'adresse mail est deja utilisee");
        }
      }
      /*$gids_with_same_phone = Gid::query()->where(['telephone' => $params['telephone']]);
      if ($users_with_same_phone->count() > 0) {
        $users_with_same_phone = $users_with_same_phone->first();
        if ($users_with_same_phone->user_id != $user->user_id) {
          array_push($errors, "Le numero de tel est deja utilise");
        }
      }*/
      $mail_changed = $params['edit_gid_email'] ;//!= $user->email;
      if (count($errors) == 0) {
        unset($params['edit_gid_password_ver']);
        if(!empty($params['edit_gid_pass'])){
          if($gid->pass!=$params['edit_gid_pass']){
            $params['edit_gid_pass'] = sha1($params['edit_gid_pass']);
            $gid->pass = $params['edit_gid_pass'];
          }
        }
        $gid->idorigine = $params['edit_gid_idorigine'];
        $gid->gid = $params['edit_gid'];
        $gid->idorigine = $params['edit_gid_idorigine'];
        $gid->nom = $params['edit_gid_nom'];
        $gid->prenom = $params['edit_gid_prenom'];
        $gid->email = $params['edit_gid_email'];
        $gid->origine = $params['edit_gid_origine'];
        $gid->direction = $params['edit_gid_direction'];
        $gid->update($params);
       //echo $params;
       //die();
        $success = 'Mise a jour complet';
        if ($mail_changed) {
          //$user->email_verified = false;
          $gid->save();
          // generateVerToken();
          return redirect("/app-gid-list");
        }
      }
    }

    return view('/pages/app-gid-list', [
      'breadcrumbs' => $breadcrumbs,
      'origines'=>$origines,
      'directions'=>$directions]);

  }
  public function gid_create(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Create gid"]
    ];
    global $title;
    $title = "gid";
    $errors = [];
    if (!userLoggedIn()) {
      redirect('/');
    }

    $errors = [];
    if (!empty(request('password_ver'))) {
//        "first_name", "last_name", "email", "telephone", "password", "email_verified", "created_at", "updated_at", "type"
      $params = request()->toArray();
      // $params['email_verified'] = 0;
      //$params['type'] = 0;
      $origine = Origine::query()->where('origine', '=', $params['origine'])->first();
      if ($params['pass'] != $params['password_ver']) {
        array_push($errors, "Les mots de passe ne correspondent pas");
      } else if (Gid::query()->where(['email' => $params['email']])->count() > 0) {
        array_push($errors, "Cette adresse est deja utilisee");
        /* } else if (Gid::query()->where(['telephone' => $params['telephone']])->count() > 0) {
           array_push($errors, "Ce numero de telephone est deja utilise");*/
      } else {
        $params['pass'] = sha1($params['pass']);
        $params['idorigine'] = $origine->idorigine;
        var_dump( $params);
         $gid = Gid::query()->create($params);
        // log_user_in($user->user_id);
        return redirect('app-gid-list');
      }
    }

// $gid = Gid::query()->create($params);
    return redirect('app-gid-list')->with('success',"Enregistrement effectuer avec success");
  }

//////// END gid //////////////////////////




//////// START origine //////////////////////////
///
  public function origine_index(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Origine create"]
    ];

//$origines = Origine::all();
//$directions = Direction::all();
//$origines =$directions;
    return view('/pages/app-origine-create',[
      'breadcrumbs' => $breadcrumbs]);

  }
  public function origine_list(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"origine"]
    ];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    if ($request->has("ismodif")) {
      $params = $request->all();
      $origine = Origine::query()->where("idorigine", '=', $params['edit_origine_id'])->first();
     // echo $origine;
//  echo $params;
      $origine->origine = $params['edit_origine_name'];
      $origine->save($params);
      //echo $origine;
//echo $params;
//return redirect("/app-origine-list");
    }

    return view('/pages/app-origine-list', [
      'breadcrumbs' => $breadcrumbs]);

  }
  public function origine_create(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Create origine"]
    ];
    global $title;
    $title = "origine";
    $errors = [];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $origines = Origine::all();
    $params = request()->toArray();
    $classes =[];
    if (count($params)!==0){
      foreach ($origines as $origine){
        if($origine->derection == $params["origine"]){
          array_push($errors, "La origine existe deja");
        }
      }
      if (count($errors)==0){
        $origine = Origine::query()->create($params);
        array_push($classes,"add_origine_success add_origine_error");
      }else{
        array_push($classes,"add_origine_error");
      }
    }

// $origine = Origine::query()->create($params);
    return redirect('app-origine-list')->with('success',"Enregistrement effectuer avec success");
  }

//////// END origine //////////////////////////
///
///
///


//////// START causePareto //////////////////////////

  public function causePareto_index(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Cause Pareto"]
    ];

//$causeParetos = CausePareto::all();
//$directions = Direction::all();
//$causeParetos =$directions;
    return view('/pages/app-causePareto-create',[
      'breadcrumbs' => $breadcrumbs]);

  }

  public function causePareto_list(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"causePareto"]
    ];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $title = "Mettre a jour mes informations";
    $request = request();
    $errors = [];
    $success = '';
    if ($request->has("ismodif")) {
      $params = $request->all();
      $causePareto = CausePareto::query()->where("idcausePareto", '=', $params['edit_causePareto_id'])->first();
//echo $causePareto;
//  echo $params;
      $causePareto->causePareto = $params['edit_causePareto_name'];
      $causePareto->save($params);
//echo $causePareto;
//echo $params;
//return redirect("/app-causePareto-list");
    }

    return view('/pages/app-causePareto-list', [
      'breadcrumbs' => $breadcrumbs]);

  }
  public function causePareto_create(){
    $breadcrumbs = [
      ['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Create causePareto"]
    ];
    global $title;
    $title = "causePareto";
    $errors = [];
    if (!userLoggedIn()) {
      redirect('/');
    }
    $causeParetos = CausePareto::all();
    $params = request()->toArray();
    $classes =[];
    if (count($params)!==0){
      foreach ($causeParetos as $causePareto){
        if($causePareto->derection == $params["causePareto"]){
          array_push($errors, "La causePareto existe deja");
        }
      }
      if (count($errors)==0){
        $causePareto = CausePareto::query()->create($params);
        array_push($classes,"add_causePareto_success add_causePareto_error");
      }else{
        array_push($classes,"add_causePareto_error");
      }
    }

// $causePareto = CausePareto::query()->create($params);
    return redirect('app-causePareto-list')->with('success',"Enregistrement effectuer avec success");
  }

//////// END causePareto //////////////////////////
}
