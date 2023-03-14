<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LDAPController extends Controller
{


    public function logIn(Request $request)
    {
        $user = (object) array(
            'name' => explode('@', $request->email)[0],
            'pass' => $request->password,
        );

        $auth = config('app.debug') === true ? true : $this->check_user($user);

        if ($auth) {

            if ($user = User::where('email', $request->email)->first() ?? User::where('name', $request->email)->first()) {
                Auth::loginUsingId($user->id);
                return redirect('/');
            } else {
                return redirect('/login')->withErrors(['email' => 'Sin Acceso a la Aplicación'])->withInput();
            }

        } else {
            //return response()->json($user);
            return redirect('/login')->withInput()->withErrors(['email' => trans('auth.failed')]);

        }
    }
    
    

    public function check_user($user)
    {
        if ($user->name == '' || $user->pass == '') {
            return false;
        }        
        $ad = ldap_connect('valoran.com');
        ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
        $auth = @ldap_bind($ad, "valoran\\$user->name", $user->pass);
        @ldap_unbind($ad);
        return $auth ? true : false;
    }

    public function logOut()
    {
        @Auth::logout();
        return redirect('/login');
    }
}
