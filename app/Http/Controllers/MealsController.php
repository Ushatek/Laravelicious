<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealType;
use App\Models\Order;
use App\Models\OrderMeal;
use Illuminate\Http\Request;

class MealsController extends Controller
{
    public function index()
    {
        $types = MealType::where("IsActive", "=", true)->get();

        return view("Meals.Index", ["types" => $types]);
    }
    //post zaleznie od wybranego formularza wysszukuje, lub dodaje zamowienie
    public function post(Request $request)
    {
        //wyszukiwanie
        if ($request->has('search')) 
        {
            $search = $request->input("search");
            $types = MealType::withwhereHas('Meals', function ($q) use ($search) //ciekawe zastosowanie polaczenia with z hereHas, zwraca tylko typy, ktore zawieraja w swojej kolekcji wyszukiwana fraze
            {
                $q->where('Name', 'LIKE', '%' . $search . '%');
            })->get();

            return view("Meals.Index", ["types" => $types]);
        } 
        //zamawianie
        else if ($request->has('orderedMeal')) 
        {
            $model = new Order();
            $model->Title = "Zamówienie-" . session('nazwazalogowanego') . "-" . date('d-m-Y-H:i:s');
            $model->CreatedBy = session('nazwazalogowanego');
            $model->OrderStatutsId = 1; //status 1, czyli "zlozone"
            $model->UsersId = session('idzalogowanego');
            $model->LastEditedBy = session('nazwazalogowanego');
            $model->IsActive = true;
            $model->save();
            $number = 0; //zmienna pomocniacza
            $count = 0; //zlicza czy wprowadzony był jakiś produkt na zamówieniu, jak nie to nie dodajemy zamówienia
            foreach ($_POST["orderedMeal"]["MealId"] as $meal) 
            {
                if ($_POST["orderedMeal"]["ilosc"][$number] > 0) 
                {
                    $modelMeal = new OrderMeal();
                    $modelMeal->Title = "Pozycja-" . $number + 1;
                    $modelMeal->OrdersId = $model->Id;
                    $modelMeal->MealsId = $meal;
                    $modelMeal->Amount = intval($_POST["orderedMeal"]["ilosc"][$number]);//konwercja naliczbe calkowita gdyby uzytkownik przelal double
                    $modelMeal->Price = Meal::find($meal)->Price;
                    $modelMeal->CreatedBy = session('nazwazalogowanego');
                    $modelMeal->LastEditedBy = session('nazwazalogowanego');
                    $modelMeal->IsActive = true;
                    $modelMeal->save();
                    $count++;
                }
                $number++;
            }
            if ($count == 0) //nie dodano produktu, usuwamy order z bd i wyswietlamy błąd
            {
                $model->delete();
                return redirect("/menu")->with('message', 'Nie podano produktów.');
            }
            return redirect("/zamowienia");
        }
    }

    public function edit($id)
    {
        $model = Meal::find($id);
        $types = MealType::where("IsActive", "=", true)->get();
        return view("Meals.Edit", ["model" => $model, "types" => $types]);
    }
    public function update($id, Request $request)
    {
        $model = Meal::find($id);
        $model->Title = $request->input("Title");
        $model->Name = $request->input("Name");
        if (!is_numeric($request->input("Price")) || $request->input("Price") <= 0) //walidacja ceny - musi być liczbą wiekszą od zera
        {
            return redirect("/menu/edycja/$id")->with('message', 'Podano błędną cenę.');
        }
        $model->Price = $request->input("Price");
        if ($request->input("MealTypesId") == "Wybierz rodzaj dania") //sprawdzanie czy wybrano z listy typ
        {
            return redirect("/menu/edycja/$id")->with('message', 'Nie wybrano typu dania.');
        }
        $model->MealTypesId = $request->input("MealTypesId");
        $model->LastEditedBy = session('nazwazalogowanego');
        $model->save();

        return redirect("/menu");
    }

    public function create()
    {
        $model = new Meal();
        $types = MealType::where("IsActive", "=", true)->get();
        return view("Meals.Create", ["model" => $model, "types" => $types]);
    }

    public function addToDB(Request $request)
    {
        $model = new Meal();
        $model->Title = $request->input("Title");
        $model->Name = $request->input("Name");
        if (!is_numeric($request->input("Price")) || $request->input("Price") <= 0) //walidacja ceny - musi być liczbą wiekszą od zera
        {
            return redirect("/menu/dodawanie")->with('message', 'Podano błędną cenę.');
        }
        $model->Price = $request->input("Price");
        if ($request->input("MealTypesId") == "Wybierz rodzaj dania") //sprawdzanie czy wybrano z listy typ
        {
            return redirect("/menu/dodawanie")->with('message', 'Nie wybrano typu dania.');
        }
        $model->MealTypesId = $request->input("MealTypesId");
        $model->CreatedBy = session('nazwazalogowanego');
        $model->LastEditedBy = session('nazwazalogowanego');
        $model->IsActive = true;

        $model->save();
        return redirect("/menu");
    }

    public function createType()
    {
        $model = new MealType();
        return view("Meals.CreateType", ["model" => $model]);
    }

    public function addTypeToDB(Request $request)
    {
        $model = new MealType();
        $model->Title = $request->input("Title");
        $model->Name = $request->input("Name");
        $model->CreatedBy = session('nazwazalogowanego');
        $model->LastEditedBy = session('nazwazalogowanego');
        $model->IsActive = true;

        $model->save();
        return redirect("/menu");
    }

    public function editType($id)
    {
        $model = MealType::find($id);
        return view("Meals.EditType", ["model" => $model]);
    }
    public function updateType($id, Request $request)
    {
        $model = MealType::find($id);
        $model->Title = $request->input("Title");
        $model->Name = $request->input("Name");
        $model->LastEditedBy = session('nazwazalogowanego');
        $model->save();

        return redirect("/menu");
    }

    public function delete($id)
    {
        //usuwanie (preprawony link) działa tylko jeśli odpowiedni użytkownik zalogowany w sesji
        if (Session("typzalogowanego") == 1) 
        {
            $model = Meal::find($id);
            $model->IsActive = false;
            $model->save();
        }

        return redirect("/menu");
    }

    //walidacja ceny nowego porduktu
    public function validateModel(Request $request)
    {
        if($request -> input("property") == "Cena")//jesli wpisano cene
        {
            if(is_numeric($request -> input("value")))//jesli cena jest liczba
            {
                if($request -> input("value") < 0)//jesli cena ujemna to blad
                    return response()->json(["error" => "Cena nie może być ujemna"]);
                else
                    return response()->json(["error" => ""]);
            }
            else//nie podano liczby jako cena
            {
                return response()->json(["error" => "Cena musi być liczbą!"]);
            }
        }
        else
            return response()->json(["error" => ""]);
    }
}
