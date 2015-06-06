<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Models\User;
use Lbc\GetFrom;

class UserController extends BaseController
{
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
