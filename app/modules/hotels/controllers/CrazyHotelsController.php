<?php
namespace AlFuttaim\Modules\Hotels\Controllers;

use Phalcon\Mvc\Controller;
use Phalgon\Tag;
use Phalcon\Mvc\Dispatcher;
use AlFuttaim\Modules\Hotels\Models\Hotels;
use AlFuttaim\Modules\Hotels\Repositories\HotelsRepository;
use AlFuttaim\Modules\Hotels\Views\CrazyHotelsView;
use AlFuttaim\Modules\Hotels\Services\HotelsService;

class CrazyHotelsController extends Controller
{
    protected $hotelsService;

    public function initialize() {
    
        $this->hotelsService = new HotelsService();
    }

    /*
        API:    http://localhost/alfuttaim/crazyHotels?city=AMM&from=2018-10-23T23:15:30&adultsCount=4
        METHOD: GET
        Request:
            - city: IATA code (AUH)
            - from ISO_INSTANT
            - To ISO_INSTANT
            - adultsCount: integer number
            
        Response:
            - hotelName: Name of the hotel
            - rate: String of &#39;*&#39; from 1-5, Eg: *, *****
            - price: Price of the hotel per night
            - discount: discount on the room (if available).
            - amenities: array of strings.
    */

    public function listAction()
    {
        $fromDate = $this->request->getQuery("from");
        $toDate = $this->request->getQuery("to");
        $numberOfAdults = $this->request->getQuery("adultsCount");
        $city = $this->request->getQuery("city");
        
        $inWhere=[["provider",["CrazyHotels"]]];
        
        // sample of time ISO_INSTANT: "2011-12-03T10:15:30Z"
        if ((isset($fromDate))) {
            $inWhere [] = ["fromDate",date("Y-m-d",strtotime($fromDate))];
        }

        // sample of time ISO_INSTANT: "2011-12-03T10:15:30Z"
        if ((isset($toDate))) {
            $inWhere [] = ["toDate",date("Y-m-d",strtotime($toDate))] ;
        }
        if ((isset($numberOfAdults))) {
            $inWhere [] = ["numberOfAdults",[$numberOfAdults]] ;
        }
        if ((isset($city))) {
            $inWhere [] = ["city",[$city]];
        }

        $data = $this->hotelsService->getHotels($inWhere);

        $crazyHotelsView = new CrazyHotelsView();
        return $crazyHotelsView->render($data);
    }
}