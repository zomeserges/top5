<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
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
        $title = "Inscription";


        $errors = [];
        if (!empty(request('password_ver'))) {
//        "first_name", "last_name", "email", "telephone", "password", "email_verified", "created_at", "updated_at", "type"
            $params = request()->toArray();
           // $params['email_verified'] = 0;
            //$params['type'] = 0;

            if ($params['password'] != $params['password_ver']) {
                array_push($errors, "Les mots de passe ne correspondent pas");
            } else if (User::query()->where(['email' => $params['email']])->count() > 0) {
                array_push($errors, "Cette adresse est deja utilisee");
            } else if (User::query()->where(['telephone' => $params['telephone']])->count() > 0) {
                array_push($errors, "Ce numero de telephone est deja utilise");
            } else {
                $params['password'] = sha1($params['password']);
                $user = User::query()->create($params);
                log_user_in($user->user_id);
                return redirect('pages/page-user-profile');
            }
        }

        return view('pages/auth-register', [
          'pageConfigs' => $pageConfigs])->with(['errors' => $errors]);

    }

    public function login()
    {
      $pageConfigs = [
        'bodyClass' => "bg-full-screen-image",
        'blankPage' => true
      ];
        $errors = [];
        if (userLoggedIn()) {
            return redirect('/page-user-profile');
        }

        if (!empty(request('password'))) {
            $params = request()->toArray();
            $params['password'] = sha1($params['password']);
            unset($params['_token']); //rempove the token parameter for csrf
            if (isset($params['__redir'])) {
                $redir = $params['__redir'];
                unset($params['__redir']); //rempove the redirection token
            }

            $users = User::query()->where($params);
            if ($users->count() > 0) {
                $user = $users->first();
                log_user_in($user->user_id);
                if (!empty($redir)) {
                    return redirect($redir);
                }
                return redirect('/page-user-profile');
            } else {
                array_push($errors, "Aucun utilisateur existant");
            }
        }
        global $title;
        $title = "Connexion";
        return view('pages/auth-login', [
          'pageConfigs' => $pageConfigs])->with(['errors' => $errors]);

    }





  /**
   * type  =>0-student, 1-teacher
   * @param $userId
   */
  private  $UID_KEY = 'uid-key';




    public function myAccount()
    {
        if (!userLoggedIn()) {
            return redirect('/login');
        }
        $user = getCurrentUser();
        if (!empty($user->type)) { // a teacher
            return redirect('/account/formations');
        }
        return view('u0-formations');
    }



    public function accountEdit1()
    {
        if (!userLoggedIn()) {
            redirect('/login?__redir=' . urlencode(\Illuminate\Support\Facades\Request::fullUrl()));
        }
        global $title;
        $title = "Mettre a jour mes informations";
        $user = getCurrentUser();
        $request = request();
        $errors = [];
        $success = '';
        if ($request->has("ismodif")) {
            $params = $request->all();
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
            $mail_changed = $params['email'] != $user->email;
            if (count($errors) == 0) {
                unset($params['password2']);
                $params['password'] = sha1($params['password']);
                $user->update($params);
                $success = 'Mise a jour complet';
                if ($mail_changed) {
                    $user->email_verified = false;
                    $user->save();
                    generateVerToken();
                    return redirect("/my-account");
                }
            }
        }
        return view('u0-account-edit', ['errors' => $errors, 'success' => $success, 'user' => $user]);

    }

    public function accountEdit2(){
        if (!userLoggedIn()) {
            redirect('/login?__redir=' . urlencode(\Illuminate\Support\Facades\Request::fullUrl()));
        }
        global $title;
        $title = "Mettre a jour mes informations";
        $user = getCurrentUser();
        $request = request();
        $errors = [];
        $success = '';
        if ($request->has("ismodif")) {
            $params = $request->all();
            if ((!empty($params['password']) || !empty($params['password2'])) && $params['password'] != $params['password2']) {
                array_push($errors, "Les deux mots de passes ne sont pas identiques");
            }
            $users_with_same_mail = \App\MUser::query()->where(['email' => $params['email']]);
            if ($users_with_same_mail->count() > 0) {
                $users_with_same_mail = $users_with_same_mail->first();
                if ($users_with_same_mail->user_id != $user->user_id) {
                    array_push($errors, "L'adresse mail est deja utilisee");
                }
            }
            $users_with_same_phone = \App\MUser::query()->where(['telephone' => $params['telephone']]);
            if ($users_with_same_phone->count() > 0) {
                $users_with_same_phone = $users_with_same_phone->first();
                if ($users_with_same_phone->user_id != $user->user_id) {
                    array_push($errors, "Le numero de tel est deja utilise");
                }
            }
            $mail_changed = $params['email'] != $user->email;
            if (count($errors) == 0) {
                unset($params['password2']);
                $params['password'] = sha1($params['password']);
                $user->update($params);
                $success = 'Mise a jour complet';
                if ($mail_changed) {
                    $user->email_verified = false;
                    $user->save();
                    generateVerToken();
                    generateVerToken();
                    return redirect("/my-account");
                }
            }
        }
        return view('u-account-edit', ['errors' => $errors, 'success' => $success, 'user' => $user]);

    }

    public function becomeFormer(){
        /*  if(userLoggedIn()){
          return redirect('/my-account');
      }*/
        global $title;
        $title = "Devenir Formateur";


        $errors = [];
        if (!empty(request('password_ver'))) {
//        "first_name", "last_name", "email", "telephone", "password", "email_verified", "created_at", "updated_at", "type"
            $params = request()->toArray();
            $params['email_verified'] = 0;
            $params['type'] = 1;
            if ($params['password'] != $params['password_ver']) {
                array_push($errors, "Les mots de passe ne correspondent pas");
            } else if (\App\MUser::query()->where(['email' => $params['email']])->count() > 0) {
                array_push($errors, "Cette adresse est deja utilisee");
            } else if (\App\MUser::query()->where(['telephone' => $params['telephone']])->count() > 0) {
                array_push($errors, "Ce numero de telephone est deja utilise");
            } else {
                $params['password'] = sha1($params['password']);
                $user = \App\MUser::query()->create($params);
                $this->log_user_in($user->user_id);
                return redirect('/former/pay');
            }
        }
        return view('register-former')->with(['errors' => $errors]);

    }

    public function changePw(){
        //    generateVerToken();
        global $title;
        $title = "Change your password";
        if (userLoggedIn()) {
            abort(404);
        }
        $errors = [];
        if (!empty(request("ver_token")) && !empty('email')) {
            $query = \App\MUser::query()->where(["email" => request('email'), "ver_token" => request('ver_token')]);
            if ($query->count() > 0) {
                if (!empty(request('ismodif')) && !empty(request('password')) && !empty(request('password2'))) {
                    $request = request()->all();
                    if ($request['password'] == $request['password2']) {
                        if (strlen($request['password']) < 6) {
                            array_push($errors, "Le mot de passse est vraiment court");
                        } else {
                            $user = $query->first();
                            $user->ver_token = null;
                            $user->password = sha1($request['password']);
                            $user->save();
                            return redirect("/login");
                        }
                    } else {
                        array_push($errors, "Les mots de passes ne sont pas identques");
                    }
                }
            } else {
                abort(404);
            }
        }
        return view("change-password", ["errors" => $errors]);

    }
    public function sendEmail(){
        $errors = [];
        $success = false;
        if (!empty(request('email'))) {
            $user = \App\MUser::query()->where('email', request('email'));
            if ($user->count() > 0) {
                $success = true;
                lostPassword(request('email'));
            } else {
                array_push($errors, "Cette adresse mail n'existe pas");
            }
        }
        return view('enter-email', ['errors' => $errors, 'success' => $success]);

    }
}
