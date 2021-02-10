<?php
/**
 * type  =>0-student, 1-teacher
 * @param $userId
 */
const UID_KEY = 'uid-key';
use App\Models\Action;
use App\Models\CausePareto;
use App\Models\Direction;
use App\Models\Escalade;
use App\Models\Gid;
use App\Models\Indicateur;
use App\Models\Origine;
use App\Models\Pdca;
use App\Models\Sqdip;
use App\Models\User;
use \Illuminate\Support\Facades\Cookie;
use \Illuminate\Support\Facades\Crypt;
function log_user_in($userId)
{
  Cookie::queue(UID_KEY, $userId, 60 * 24 * 30);
}

function userLoggedIn()
{
  return !empty(getLoggedInuserId());
}

function getLoggedInuserId()
{
  return request()->cookie(UID_KEY);
}

function getCurrentUser()
{
  $user = User::query()->find(getLoggedInuserId());
  if (empty($user) && !empty(getLoggedInuserId())) {
    $user = User::query()->find(Crypt::decrypt(getLoggedInuserId(), false));
  }
  return $user;
}
 function getUsers(){
  $users = User::all();
  // Fetch all records
   // Write File
   $useJsonString = json_encode($users, JSON_PRETTY_PRINT);
  $userData['data'] = $users;
  file_put_contents(base_path('public/data/user-data/user-list.json'), stripslashes($useJsonString));

  //Storage::disk('public/data/user-data')->put('user-list.json', response()->json($users));

  //echo json_encode($userData);
  //exit;
}
function getDirections(){
  $directions = Direction::all();
  // Fetch all records
  // Write File
  $directionJsonString = json_encode($directions, JSON_PRETTY_PRINT);
  $directionData['data'] = $directions;
  file_put_contents(base_path('public/data/direction-data/direction-list.json'), stripslashes($directionJsonString));

}

function getSqdips(){
  $sqdips = Sqdip::all();
  // Fetch all records
  // Write File
  $sqdipJsonString = json_encode($sqdips, JSON_PRETTY_PRINT);
  $sqdipData['data'] = $sqdips;
  file_put_contents(base_path('public/data/sqdip-data/sqdip-list.json'), stripslashes($sqdipJsonString));

}

function getEscalades(){
  $escalades = Escalade::all();
  // Fetch all records
  // Write File
  $escaladeJsonString = json_encode($escalades, JSON_PRETTY_PRINT);
  $escaladeData['data'] = $escalades;
  file_put_contents(base_path('public/data/escalade-data/escalade-list.json'), stripslashes($escaladeJsonString));

}

// PDCA
function getPdcas(){
  $pdcas = PDCA::all();
// Fetch all records
// Write File
  $pdcaJsonString = json_encode($pdcas, JSON_PRETTY_PRINT);
  $pdcaData['data'] = $pdcas;
  file_put_contents(base_path('public/data/pdca-data/pdca-list.json'), stripslashes($pdcaJsonString));

}


// helpers GID

function getGids(){
  $gids = GID::all();
// Fetch all records
// Write File
  $gidJsonString = json_encode($gids, JSON_PRETTY_PRINT);
  $gidData['data'] = $gids;
  file_put_contents(base_path('public/data/gid-data/gid-list.json'), stripslashes($gidJsonString));

}


// helpers origine

function getOrigines(){
  $origines = Origine::all();
// Fetch all records
// Write File
  $origineJsonString = json_encode($origines, JSON_PRETTY_PRINT);
  $origineData['data'] = $origines;
  file_put_contents(base_path('public/data/origine-data/origine-list.json'), stripslashes($origineJsonString));

}

function getCauseParetos(){
  $causeParetos = CausePareto::all();
  foreach ($causeParetos as $causePareto){
  }

  $causeParetoJsonString = json_encode($causeParetos, JSON_PRETTY_PRINT);
  $causeParetoData['data'] = $causeParetos;
  file_put_contents(base_path('public/data/causePareto-data/causePareto-list.json'), stripslashes($causeParetoJsonString));

}


// helpers indicateur
function getindicateurs(){
  $indicateurs = Indicateur::all();
  $indicateurJsonString = json_encode($indicateurs, JSON_PRETTY_PRINT);
  $indicateurData['data'] = $indicateurs;
  file_put_contents(base_path('public/data/indicateur-data/indicateur-list.json'), stripslashes($indicateurJsonString));

}

// helpers action

function getActions(){
  $actions = Action::all();
// Fetch all records
// Write File
  $actionJsonString = json_encode($actions, JSON_PRETTY_PRINT);
  $actionData['data'] = $actions;
  file_put_contents(base_path('public/data/action-data/action-list.json'), stripslashes($actionJsonString));

}

