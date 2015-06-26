<?php namespace App\Http\Controllers;

use Facebook\FacebookSession;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Models\User;
use Lbc\GetFrom;
use Auth;
use Illuminate\Http\Response;

class UserController extends BaseController
{
   	
    public function __construct()
    {
        FacebookSession::setDefaultApplication('423496154496720', 'c28cf6fe706e4e6c03906f85df9e398e');
    }

    public function checkUser(Request $request)
    {
        $helper = new FacebookJavaScriptLoginHelper();
        try {
            $session = $helper->getSession();
        } catch(FacebookRequestException $ex) {
            // When Facebook returns an error
            return [$ex->getMessage()];
        } catch(\Exception $ex) {
            return [$ex->getMessage()];
            // When validation fails or other local issues
        }
        if ($session) {
            return $this->retrieveUser($session);
        } else {
            return ['bouhh'];
        }
    }

    public function retrieveUser($session)
    {
        try {
            $user_profile = (new FacebookRequest($session, 'GET', '/me'))
            ->execute()
            ->getGraphObject(GraphUser::className());

            $user = $user_profile->asArray();
            $user_bdd = User::firstOrCreate(array('email' => $user['email']));
            $user_bdd->id = $user['id'];
            $user_bdd->first_name = $user['first_name'];
            $user_bdd->last_name = $user['last_name'];
            $user_bdd->gender = $user['gender'];
            $user_bdd->locale = $user['locale'];
            $user_bdd->timezone = $user['timezone'];

            if ($user_bdd->save()) {
                // Auth::loginUsingId($user_bdd->id);
                return $user;
            }
            return [false];

        } catch(FacebookRequestException $e) {
            // echo "Exception occured, code: " . $e->getCode();
            return  ["Error with message: " . $e->getMessage()];
        }
        
    }

    public function create(Request $request)
    {
        $inputs = $request->input();
        $user = new User;
        $user->params = json_encode($inputs);
        $user->email = $request->input('style');
        $user->save();

        return $user;

        //
    }

    public function getauto()
    {
        $getfrom = new GetFrom;
        $search = $getfrom->search("http://www.leboncoin.fr/voitures/offres/ile_de_france/?f=a&th=1&rs=2011&q=mercedes+slk", true);
        
        foreach ($search['ads'] as $key => &$value) {
            //return $key.' et '.$value->id;
            $value->detail = $getfrom->ad($key, 'voitures');
        }

        return $search;
    }
}
