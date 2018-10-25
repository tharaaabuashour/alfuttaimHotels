<?php
/*
    THIS FILE USED TO SERVICE ALL APIS
*/

namespace AlFuttaim\Modules\Hotels\Services;

use AlFuttaim\Modules\Hotels\Models\Hotels;
use AlFuttaim\Modules\Hotels\Repositories\HotelsRepository;

class HotelsService extends \Phalcon\Mvc\User\Component
{
    protected $hotelsRepository;

    public function deleteHotel($hotel) {
        $hotelsRepository = new HotelsRepository();
        return $hotelsRepository->delete($hotel);
    }

    public function createHotel($request, $provider) {
        // CONVERT JSON TO OBJECT!
        $requestArr = json_decode($request);

        // CREATE NEW HOTEL
        $hotel = new Hotels();
        $hotel->setName(isset($requestArr->name)? $requestArr->name : null);
        $hotel->setProvider($provider);
        $hotel->setFare(isset($requestArr->fare)? $requestArr->fare: null);
        $hotel->setCity(isset($requestArr->city)? $requestArr->city: null);
        $hotel->setNumberOfAdults(isset($requestArr->numberOfAdults)? $requestArr->numberOfAdults: null);
        $hotel->setRate(isset($requestArr->rate)? $requestArr->rate: null);
        $hotel->setDiscount(isset($requestArr->discount)? $requestArr->discount: null);
        $hotel->setAmenities(isset($requestArr->amenities)? json_encode( $requestArr->amenities): null);

        $hotelsRepository = new HotelsRepository();
        return $hotelsRepository->save($hotel);
    }

    public function updateHotel($hotel, $request) {
        // CONVERT JSON TO OBJECT!
        $requestArr = json_decode($request);

        if (isset($requestArr->name)) {
            $hotel->setName($requestArr->name);
        }
        if (isset($requestArr->fare)) {
            $hotel->setFare($requestArr->fare);
        }
        if (isset($requestArr->city)) {
            $hotel->setCity($requestArr->city);
        }
        if (isset($requestArr->numberOfAdults)) {
            $hotel->setNumberOfAdults($requestArr->numberOfAdults);
        }
        if (isset($requestArr->rate)) {
            $hotel->setRate($requestArr->rate);
        }
        if (isset($requestArr->discount)) {
            $hotel->setDiscount($requestArr->discount);
        }
        if (isset($requestArr->discount)) {
            $hotel->setDiscount($requestArr->discount);
        }
        if (isset($requestArr->amenities)) {
            $hotel->setAmenities(json_encode( $requestArr->amenities));
        }

        $hotelsRepository = new HotelsRepository();
        return $hotelsRepository->update($hotel);
        
    }
    public function getHotels($inWhere=[]) {
        $hotelsRepository = new HotelsRepository();
        $data = $hotelsRepository->getHotels($inWhere);
        
        return $data;
    }
}
