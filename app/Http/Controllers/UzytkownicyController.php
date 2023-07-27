<?php

namespace App\Http\Controllers;

use App\Models\Uzytkownik;
use Illuminate\Http\Request;

class UzytkownicyController extends Controller
{
    public function index()
    {
        $message = "";
        $model = new Uzytkownik();
        return view("Users.Index", ["model" => $model, "message" => $message]);
    }

    public function loginUser(Request $request)
    {
        $message = "";
        $users = Uzytkownik::where("IsActive", "=", true)->get(); //pobieranie aktywnych uzytkownikow
        foreach ($users as $user) 
        {
            if ($user->Name == $request->input("Name")) 
            {
                if ($user->Password == $request->input("Password")) 
                {
                    session(['idzalogowanego' => $user -> Id]);
                    session(['nazwazalogowanego' => $user -> Name]);
                    session(['typzalogowanego' => $user -> UserTypesId]);
                    $message = "Zalogowano pomyślnie, witaj " . session('nazwazalogowanego');;
                    return view("Home.Index", ["message" => $message]);
                } 
                else 
                {
                    $message = 'Błędne hasło! Spróbuj ponownie.';
                    return view("Users.Index", ["message" => $message]);
                }
            }
            $message =  'Błędny login! Spróbuj ponownie.';
        }
        return view("Home.Index", ["message" => $message]);
    }

    public function logoutUser(Request $request)
    {
        $request->session()->flush();//czyścimy dane sesji przy wylogowaniu
        return view("Users.Logout");
    }

    public function create()
    {
        $model = new Uzytkownik();
        return view("Users.Create", ["model" => $model]);
    }

    public function addToDB(Request $request)
    {
        $model = new Uzytkownik();
        $users = Uzytkownik::where("IsActive", "=", true)->get(); //pobieranie aktywnych uzytkownikow
        foreach($users as $user)//sprawdzamy czy uzytkownik o danym loginie istnieje w bd
        {
            if($user -> Name == $request->input("Name"))//istnieje wiec zwracamy wiadomosc o bledzie
            {
                return redirect("/rejestracja")->with('message', 'Użytkownik o tej nazwie już istnieje.');
            }
        }

        if(strlen($request->input("Name")) < 6) //login co najmniej 6 znakow
        {
            return redirect("/rejestracja")->with('message', 'Nazwa użytkownika musi posiadać co najmniej 6 znaków.');
        }
        if(strlen($request->input("Password")) < 8) //haslo co najmniej 8 znaków
        {
            return redirect("/rejestracja")->with('message', 'Hasło musi posiadać co najmniej 8 znaków.');
        }
        $model->Title = $request->input("Name");
        $model->Name = $request->input("Name");
        $model->Password = $request->input("Password");
        $model->UserTypesId = 2; //zwykly formularz rejestracji moze tworzyć tylko zwykłych użytkowników, nie pracowników
        $model->CreatedBy = $request->input("Name");
        $model->LastEditedBy = $request->input("Name");
        $model->IsActive = true;

        $model->save();
        return redirect("/logowanie")->with('message', 'Pomyślnie utworzono konto. Zaloguj się.');
    }

    public function validateModel(Request $request)
    {
        if($request -> input("property") == "Name")//jesli wpisano nazwe uzytkownika
        {
            if(strlen($request -> input("value")) < 6)//jesli dlugosc nazwy jest krotsza niz 6 znakow
                return response()->json(["error" => "Nazwa uzytkownika musi zawierać co najmniej 6 znaków!"]);
            else
                return response()->json(["error" => ""]);
        }
        elseif ($request -> input("property") == "Pass")
        {
            if(strlen($request -> input("value")) < 8)//jesli dlugosc hasla jest krotsza niz 8 znakow
                return response()->json(["error" => "Hasło musi zawierać co najmniej 8 znaków!"]);
            else
                return response()->json(["error" => ""]);
        }
        else
            return response()->json(["error" => ""]);
    }
}
