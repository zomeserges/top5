//////// START causePareto //////////////////////////

public function causePareto_index(){
$breadcrumbs = [
['link'=>"dashboard-analytics",'name'=>"Home"], ['link'=>"dashboard-analytics",'name'=>"Pages"], ['name'=>"Cause Pareto"]
];

//$causeParetos = causePareto::all();
//$directions = Direction::all();
//$causeParetos =$directions;
return view('/pages/app-causepareto-create',[
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
$causePareto = causePareto::query()->where("idcausePareto", '=', $params['edit_causePareto_id'])->first();
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
$causeParetos = causePareto::all();
$params = request()->toArray();
$classes =[];
if (count($params)!==0){
foreach ($causeParetos as $causePareto){
if($causePareto->derection == $params["causePareto"]){
array_push($errors, "La causePareto existe deja");
}
}
if (count($errors)==0){
$causePareto = causePareto::query()->create($params);
array_push($classes,"add_causePareto_success add_causePareto_error");
}else{
array_push($classes,"add_causePareto_error");
}
}

// $causePareto = causePareto::query()->create($params);
return redirect('app-causePareto-list')->with('success',"Enregistrement effectuer avec success");
}

//////// END causePareto //////////////////////////

//causePareto Pages
Route::get('/app-causePareto-index', 'UserPagesController@causePareto_index');
Route::post('/app-causePareto-create', 'UserPagesController@causePareto_create');
Route::any('/app-causePareto-list', 'UserPagesController@causePareto_list');


// helpers

function getCauseParetos(){
$causeParetos = causePareto::all();
// Fetch all records
// Write File
$causeParetoJsonString = json_encode($causeParetos, JSON_PRETTY_PRINT);
$causeParetoData['data'] = $causeParetos;
file_put_contents(base_path('public/data/causePareto-data/causePareto-list.json'), stripslashes($causeParetoJsonString));

}
