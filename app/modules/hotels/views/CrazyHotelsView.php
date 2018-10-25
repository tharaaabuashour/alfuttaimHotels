<?php
/*  
    THIS FILE USED TO VIEW CRAZYHOTELS
        - hotelName: Name of the hotel
        - rate: String of &#39;*&#39; from 1-5, Eg: *, *****
        - price: Price of the hotel per night
        - discount: discount on the room (if available).
        - amenities: array of strings.
*/

namespace AlFuttaim\Modules\Hotels\Views;

use Phalcon\Mvc\Model\Row;
use AlFuttaim\Modules\Hotels\Models\Hotels;

class CrazyHotelsView
{   
    public function render($data)
    {   
        $viewableFields = ["hotelName","rate", "price", "discount","amenities"];

        $result=[];
        if ($data) {
            foreach ($data as $hotel) {
                // ITERATE OVER MODEL FIELDS
                $hotelArr =[];
                foreach ($viewableFields as $field) {
                
                    switch ($field) {
                        case "hotelName":
                            $hotelArr["hotelName"] = $hotel->getName();
                        break;
                        case "rate":
                            $hotelArr["rate"] = str_repeat("*",$hotel->getRate());
                        break;
                        case "price":
                            $hotelArr["price"] = $hotel->getFare();
                        break;
                        case "discount":
                            $hotelDiscount = $hotel->getDiscount();
                            if ($hotelDiscount) {
                                $hotelArr["discount"] = $hotelDiscount;
                            }
                        break;
                        case "amenities":
                            $amenitiesObj=json_decode($hotel->getAmenities());
                            $hotelArr["amenities"] = ($amenitiesObj) ? $amenitiesObj->amenities : null;
                        break;
                    }
                }
                $result[] = $hotelArr;
            
            }
        }
        return json_encode($result);
    }
}
