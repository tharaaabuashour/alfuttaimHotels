<?php
namespace AlFuttaim\Modules\Hotels\Controllers;

use Phalcon\Mvc\Controller;
use Phalgon\Tag;
use Phalcon\Mvc\Dispatcher;
use AlFuttaim\Modules\Hotels\Models\Hotels;
use AlFuttaim\Modules\Hotels\Services\HotelsService;
use AlFuttaim\Modules\Hotels\Repositories\HotelsRepository;
use AlFuttaim\Modules\Hotels\Views\HotelsView;

class HotelsController extends Controller
{
    
    protected $hotelsService;

    public function initialize() {
    
        $this->hotelsService = new HotelsService();
    }

    // HOSTED USING THIS URL: http://localhost/alfuttaim/availableHotels?fromDate=2018-10-23&toDate=2018-10-26&city=AMM
    public function listAction()
    {    
        $fromDate = $this->request->getQuery("fromDate");
        $toDate = $this->request->getQuery("toDate");
        $numberOfAdults = $this->request->getQuery("numberOfAdults");
        $city = $this->request->getQuery("city");
        
        $inWhere =[];
        if ((isset($fromDate))) {
            $inWhere [] = ["fromDate",$fromDate];
        }
        if ((isset($toDate))) {
            $inWhere [] = ["toDate",$toDate] ;
        }
        if ((isset($numberOfAdults))) {
            $inWhere [] = ["numberOfAdults",[$numberOfAdults]] ;
        }
        if ((isset($city))) {
            $inWhere [] = ["city",[$city]];
        }

        $data = $this->hotelsService->getHotels($inWhere);
        
        $hotelsView = new HotelsView();
        return $hotelsView->render($data);
    }

    /*
        USED TO CREATE HOTELS
        1. CREATE BEST HOTEL:
            API:    http://localhost/alfuttaim/bestHotels
            METHOD: POST
            PARAMS: {"name":"HOLIDAY INN","fare":100.99,"city":"AMM","numberOfAdults":"1","rate":"4","discount":0.05,"amenities":{"amenities":["SPA", "GYM"]}}]}

        2. CREATE CRAZY HOTEL:
            API:    http://localhost/alfuttaim/crazyHotels
            METHOD: POST
            PARAMS: {"name":"Gardens Hotel","fare":50,"city":"AMM","numberOfAdults":"0","rate":"3","discount":0.05,"amenities":{"amenities":["GYM"]}}]}
    */
    public function createAction($provider)
    {    
        $request = $this->request->getRawBody(true);
        $hotel   = $this->hotelsService->createHotel($request, $provider);
        
        return json_encode($hotel);
    }

    
    /*
        USED TO UPDATE HOTELS
        1. UPDATE BEST HOTEL:
            API:    http://localhost/alfuttaim/bestHotels/1
            METHOD: PUT
            PARAMS: {"name":"HOLIDAY INN - NEW"}

         2. UPDATE CRAZY HOTEL:
            API:    http://localhost/alfuttaim/crazyHotels/2
            METHOD: PUT
            PARAMS: {"name":"Gardens Hotel","fare":50,"city":"AMM","numberOfAdults":"0","rate":"3","discount":0.05,"amenities":{"amenities":["GYM"]}}]}
    */
    public function updateAction($id, $provider)
    {   
        $hotel = Hotels::findFirst(["id=:id: and provider=:provider:","bind"=>["id"=>$id, "provider"=> $provider]]);
        if (!$hotel) {
            throw new \Exception("Hotel Not Found");
        }
        $request = $this->request->getRawBody(true);
        $hotel = $this->hotelsService->updateHotel($hotel, $request);
        
        return json_encode(["id"=> $hotel->getId()]);
    }

    /*
        USED TO DETELE HOTELS
        1. DETELE BEST HOTEL:
            API:    http://localhost/alfuttaim/bestHotels/1
            METHOD: DELETE

        2. DETELE CRAZY HOTEL:
            API:    http://localhost/alfuttaim/crazyHotels/2
            METHOD: DELETE
    */    
    public function DeleteAction($id, $provider)
    {
        $hotel = Hotels::findFirst(["id=:id: and provider=:provider:","bind"=>["id"=>$id, "provider"=> $provider]]);
        if (!$hotel) {
            throw new \Exception("Hotel Not Found");
        }
        return $this->hotelsService->deleteHotel($hotel);

    }
     
}