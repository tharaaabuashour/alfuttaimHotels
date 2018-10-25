<?php
namespace AlFuttaim\Modules\Hotels\Controllers;

use Phalcon\Mvc\Controller;
use AlFuttaim\Modules\Hotels\Models\Hotels;
use AlFuttaim\Modules\Hotels\Repositories\HotelsRepository;
use AlFuttaim\Modules\Hotels\Views\BestHotelsView;
use AlFuttaim\Modules\Hotels\Services\HotelsService;

class BestHotelsController extends Controller
{   
    protected $hotelsService;

    public function initialize() {
    
        $this->hotelsService = new HotelsService();
    }

    /*
        API: http://localhost/alfuttaim/bestHotels
        METHOD: GET
        
        Request:
            - city IATA code (AUH)
            - fromDate ISO_LOCAL_DATE
            - toDate ISO_LOCAL_DATE
            - numberOfAdults: integer number

        Response:
            - hotel: Name of the hotel
            - hotelRate: Number from 1-5
            - hotelFare: Total price rounded to 2 decimals
            - roomAmenities: String of amenities separated by comma
    */
    public function listAction()
    {
        // THIS ACTION USED TO LIST ALL AVAILABLE HOTELS 
        $fromDate = $this->request->getQuery("fromDate"); // ISO_LOCAL_DATE
        $toDate = $this->request->getQuery("toDate"); //ISO_LOCAL_DATE
        $city = $this->request->getQuery("city"); // IATA code (AUH)
        $numberOfAdults = $this->request->getQuery("numberOfAdults");


        
        $inWhere=[["provider",["BestHotels"]]];
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
        
        // GET ALL HOTELS
        $data = $this->hotelsService->getHotels($inWhere);

        // VIEW HOTELS
        $bestHotelsView = new BestHotelsView();
        return $bestHotelsView->render($data);
    }

}