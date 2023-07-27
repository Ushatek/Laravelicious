<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealType;
use App\Models\Order;
use App\Models\OrderMeal;
use App\Models\OrderStatut;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $models = Order::where("IsActive", "=", true)->get();
        //$statuts = OrderStatut::where("IsActive", "=", true)->get();
        return view("Orders.Index", ["models" => $models]);
    }

    public function delete($id)
    {
        //usuwanie danego zamowienia działa tylko jeśli odpowiedni użytkownik zalogowany w sesji - dla ochrony przed preparowaniem linków
        if (Session("typzalogowanego") == 1) 
        {
            $model = Order::find($id);
            $model->IsActive = false;
            $model->save();
        } 
        return redirect("/zamowienia");
    }

    public function edit($id)
    {
        $model = Order::find($id);
        $modelDetails = OrderMeal::where("IsActive", "=", true)->get();
        $types = MealType::where("IsActive", "=", true)->get();
        return view("Orders.Edit", ["model" => $model, "modelDetails" => $modelDetails,"types" => $types]);
    }

    public function update($id)
    {
        $model = Order::find($id);
        $model->LastEditedBy = session('nazwazalogowanego');//zmiana ostatniej edycji
        $model->EditDateTime = date('Y-m-d H:i:s');//zmiana ostatniej edycji
        
        $orderMeals = OrderMeal::where("OrdersId", "=", $id)->get();//lista ordermeal z danego zamowienia (celowo wraz z niekatywnymi)
        
        $number = 0;//zmienna pomocniacza
        $count = 0; //zlicza czy wprowadzony był jakiś produkt na przy edycji, jak nie to nie edytujemy zamówienia
        foreach($_POST["orderedMeal"]["MealId"] as $meal)//przegladamy kazdy produkt
        {
            $exist = false;//flaga sygnalizujaca ze produkt jest w zamówieniu, więc nie dodajemy nowego tylko edytujemy
            foreach($orderMeals as $orderMeal)//przeglądamy wszystkie produkty powiązane z zamówieniem
            {
                if(!$exist && $orderMeal -> MealsId == $meal )//jesli jest już w zamówieniach dany produkt to edytujemy a nie tworzymy
                {
                    $exist = true;
                    $orderMealId = $orderMeal->Id; //zapisujemy id tego ordermeal by 2 razy nie szukac
                }              
            }
            if(!$exist && $_POST["orderedMeal"]["ilosc"][$number] > 0)//jesli produktu nie ma już a ilosc po edycji jest wieksza niz 0 to dodajwmy nowy ordermeals
            {
                $modelMeal = new OrderMeal();
                $modelMeal -> Title = "Pozycja-" . $number +1;
                $modelMeal -> OrdersId = $id;
                $modelMeal -> MealsId = $meal;
                $modelMeal -> Amount = $_POST["orderedMeal"]["ilosc"][$number];
                $modelMeal -> Price = Meal::find($meal) -> Price;
                $modelMeal -> CreatedBy = session('nazwazalogowanego');
                $modelMeal-> LastEditedBy = session('nazwazalogowanego');
                $modelMeal-> IsActive = true;
                $modelMeal->save();
                $count++;
            }
            else if($exist)//jesli pozycja juz istnieje (uzytkownik edytuje ilosc w zamówieniu)
            {
                $existingModel = OrderMeal::find($orderMealId); //wybieramy istniejacy ordermeal o wczesniej znalezionym id
                if($_POST["orderedMeal"]["ilosc"][$number] > 0)//jesli zmieniona ilosc jest wieksza od 0
                {
                    $existingModel -> Amount = $_POST["orderedMeal"]["ilosc"][$number];//zmieniamy na aktualna ilosc
                    $existingModel-> LastEditedBy = session('nazwazalogowanego');
                    $existingModel -> IsActive = true;//aktywny produkt
                    $count++;
                }
                else//jesli zmieniono ilosc na 0 to ustawiamy pozycja na nieaktywna
                {
                    $existingModel -> Amount = 0;
                    $existingModel-> LastEditedBy = session('nazwazalogowanego');
                    $existingModel->EditDateTime = date('Y-m-d H:i:s');//zmiana ostatniej edycji
                    $existingModel -> IsActive = false;
                }
                $existingModel->save(); //zapisujemy zmiany w istniejacym ordermeals
                
            }
            $number++; 

        }

        if($count == 0)//nie ma po edycji produktu z iloscia inna niz 0, anulujemy zamówienie
        {        
                return redirect("/zamowienia/anuluj/$id");
        }
        $model->save();
        return redirect("/zamowienia")->with('messageok', 'Pomyślnie edytowano zamówienie.');
    }

    public function pay($id)
    {
        //placenie danego zamowienia działa tylko jeśli odpowiedni użytkownik zalogowany w sesji - dla ochrony przed preparowaniem linków
        if (Session("typzalogowanego") == 2) 
        {
            $model = Order::find($id);
            //oplacic można tylko swoje złożone zamóienia
            if ($model->UsersId == Session("idzalogowanego") && $model->OrderStatutsId == 1) 
            {
                $model->OrderStatutsId = 2;
                $model->save();
                return redirect("/zamowienia")->with('messageok', 'Pomyślnie opłacono zamówienie.');
            }
        }
        return redirect("/zamowienia")->with('message', 'Błąd płatności.');
    }

    public function cancel($id)
    {
        $model = Order::find($id);
        //anulowanie danego zamowienia działa tylko jeśli odpowiedni użytkownik zalogowany w sesji - dla ochrony przed preparowaniem linków
        if ($model->OrderStatutsId == 1) 
        {
            //oplacic można tylko swoje złożone zamóienia
            if (Session("typzalogowanego") == 2 && $model->UsersId == Session("idzalogowanego"))
            {
                $model->OrderStatutsId = 3;
                $model->save();
                return redirect("/zamowienia")->with('messageok', 'Pomyślnie anulowano zamówienie.');
            }
            elseif (Session("typzalogowanego") == 1) 
            {
                $model->OrderStatutsId = 3;
                $model->save();
                return redirect("/zamowienia")->with('message', 'Pomyślnie anulowano zamówienie.');
            } 
        }
        return redirect("/zamowienia")->with('message', 'Błąd anulowania zamówienia.');
    }

    public function details($id)
    {
        $model = Order::find($id);
        $modelDetails = OrderMeal::where("IsActive", "=", true)->get();
        $items = Meal::where("IsActive", "=", true)->get();
        return view("Orders.Details", ["model" => $model, "modelDetails" => $modelDetails,"items" => $items]);
    }


}