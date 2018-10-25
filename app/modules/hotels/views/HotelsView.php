<?php
/*  
    THIS FILE USED TO VIEW BESTHOTELS
        - provider: name of the provider (“BestHotels” or “CrazyHotels”)
        - hotelName: Name of the hotel
        - fare: fare per night
        - amenities: array of strings
*/


namespace AlFuttaim\Modules\Hotels\Views;

use Phalcon\Mvc\Model\Row;
use AlFuttaim\Modules\Hotels\Models\Hotels;

class HotelsView
{   
    public function render($data)
    {   
        
        $viewableFields = ["provider","hotelName", "fare", "amenities"];

        $result=[];
        if ($data) {
            foreach ($data as $hotel) {
                // ITERATE OVER MODEL FIELDS
                $hotelArr =[];
                foreach ($viewableFields as $field) {
                
                    switch ($field) {
                        case "provider":
                            $hotelArr["provider"] = $hotel->getProvider();
                        break;
                        case "hotelName":
                            $hotelArr["hotelName"] = $hotel->getName();
                        break;
                        case "fare":
                            $hotelArr["fare"] = $hotel->getFare();
                        break;
                        case "amenities":
                            $amenitiesObj=json_decode($hotel->getAmenities());
                            $hotelArr["amenities"] = ($amenitiesObj) ?  $amenitiesObj->amenities : null;
                        break;
                    }
                }
                $result[] = $hotelArr;
            
            }
        }
        return json_encode($result);
    }
}
