<?php
/*  
    THIS FILE USED TO VIEW BESTHOTELS
        - hotel: Name of the hotel
        - hotelRate: Number from 1-5
        - hotelFare: Total price rounded to 2 decimals
        - roomAmenities: String of amenities separated by comma
*/
namespace AlFuttaim\Modules\Hotels\Views;

use Phalcon\Mvc\Model\Row;
use AlFuttaim\Modules\Hotels\Models\Hotels;

class BestHotelsView
{   
    public function render($data)
    {   
        
        $viewableFields = ["hotel","hotelRate", "hotelFare", "roomAmenities"];

        $result=[];
        if ($data) {
            foreach ($data as $hotel) {
                // ITERATE OVER MODEL FIELDS
                $hotelArr =[];
                foreach ($viewableFields as $field) {
                
                    switch ($field) {
                        case "hotel":
                            $hotelArr["hotel"] = $hotel->getName();
                        break;
                        case "hotelRate":
                            $hotelArr["hotelRate"] = $hotel->getRate();
                        break;
                        case "hotelFare":
                            $hotelArr["hotelFare"] = sprintf('%.2f',$hotel->getFare());
                        break;
                        case "roomAmenities":
                            $amenitiesObj=json_decode($hotel->getAmenities());
                            $hotelArr["roomAmenities"] = ($amenitiesObj) ? implode(",",$amenitiesObj->amenities) : null;
                        break;
                    }
                }
                $result[] = $hotelArr;
            
            }
        }
        return json_encode($result);
    }
}
