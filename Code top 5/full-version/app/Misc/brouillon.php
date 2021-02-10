//////// START action //////////////////////////

public function action_index(){
$breadcrumbs = [
['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Cause Pareto"]
];

//$actions = action::all();
//$directions = Direction::all();
//$actions =$directions;
return view('/pages/app-action-create',[
'breadcrumbs' => $breadcrumbs]);

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
if ($request->has("ismodif")) {
$params = $request->all();
$action = action::query()->where("idaction", '=', $params['edit_action_id'])->first();
//echo $action;
//  echo $params;
$action->action = $params['edit_action_name'];
$action->save($params);
//echo $action;
//echo $params;
//return redirect("/app-action-list");
}

return view('/pages/app-action-list', [
'breadcrumbs' => $breadcrumbs]);

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
$actions = action::all();
$params = request()->toArray();
$classes =[];
if (count($params)!==0){
foreach ($actions as $action){
if($action->derection == $params["action"]){
array_push($errors, "La action existe deja");
}
}
if (count($errors)==0){
$action = action::query()->create($params);
array_push($classes,"add_action_success add_action_error");
}else{
array_push($classes,"add_action_error");
}
}

// $action = action::query()->create($params);
return redirect('app-action-list')->with('success',"Enregistrement effectuer avec success");
}

//////// END action //////////////////////////

//action Pages
Route::get('/app-action-index', 'actionController@action_index');
Route::post('/app-action-create', 'actionController@action_create');
Route::any('/app-action-list', 'actionController@action_list');



// helpers action

function getActions(){
$actions = action::all();
// Fetch all records
// Write File
$actionJsonString = json_encode($actions, JSON_PRETTY_PRINT);
$actionData['data'] = $actions;
file_put_contents(base_path('public/data/action-data/action-list.json'), stripslashes($actionJsonString));

}

{
"url": "",
"name": "Action",
"icon": "feather icon-layout",
"submenu": [
{
"url": "app-action-list",
"name": "List Action",
"icon": "feather icon-list",
"i18n": "nav.app_action_list"
},
{
"url": "app-action-index",
"name": "Create action",
"icon": "feather icon-circle",
"i18n": "nav.app_action_index"
}
]
},

<select name="idescalade" id="action_escalade" class="form-control" required>
  <option selected value="{{request('idescalade')}}">Choose idescalade</option>
  @foreach($escalades as $escalade)
  <option value="{{$escalade->idescalade}}">{{$escalade->escalade}}</option>
  @endforeach
</select>
