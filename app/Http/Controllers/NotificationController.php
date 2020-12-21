<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('notification');
    }

    public function marcarLeidos(Request $request)
    {
        if($request->get('user_id'))
        {
            $user_id = $request->get('user_id');
            $idNotificacion = $request->get('id_notificacion');

            $user = User::find($user_id);            
            if($user)
            {
                $notificacion = $user->unreadNotifications->where('id', $idNotificacion)->first();

                if($notificacion)
                {
                    $notificacion->markAsRead();
                }
            }
            echo json_encode($response);
        }
    }

    public function cantidad(Request $request)
    {
        if($request->get('query')){
            $id = $request->get('query');
            
            $user = User::find($id);
            //$response = 0;

            if($user)
            {
                $response = $user->unreadNotifications;
            }
            
            echo json_encode($response);
        }
    }
}