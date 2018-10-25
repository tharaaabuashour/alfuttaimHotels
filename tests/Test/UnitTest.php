<?php

namespace Test;

//include __DIR__ . "/../../app/modules\hotels\services\HotelsService.php";
//include __DIR__ . "/../../app/modules\hotels\models\Hotels.php";

/**
 * Class UnitTest
 */

class UnitTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateBestHotel() {
        // TEST CREATING BEST HOTEL
        $hotelService = new \AlFuttaim\Modules\Hotels\Services\HotelsService();
        $params = [
            "name"  => "Holiday Inn",
            "fare"  => 80.99,
            "rate"  => 4
        ];
        $hotel = $hotelService->createHotel(json_encode($params), "BestHotels");
        $success = ($hotel) ? true : false;
        $this->assertTrue($success);
    }

    public function testCreateCrazyHotel() {
        // CREATE CRAZY HOTEL
        $hotelService = new \AlFuttaim\Modules\Hotels\Services\HotelsService();
        $params = [
            "name"  => "Gradens Hotel",
            "fare"  => 50.999,
            "rate"  => 3
        ];
        $hotel = $hotelService->createHotel(json_encode($params), "CrazyHotels");
        $success = ($hotel) ? true : false;
        $this->assertTrue($success);
    }
    
    public function testGetAvailableHotels() {
        // GET ALL HOTELS WITHOUT ANY CONDITION
        $hotelService = new \AlFuttaim\Modules\Hotels\Services\HotelsService();
       
        $hotels = $hotelService->getHotels();
        json_decode($hotels);
        $success = (json_last_error() == JSON_ERROR_NONE)? true : false;
        $this->assertTrue($success);
    }

    public function testBestHotels() {
        // GET ALL BEST HOTELS
        $hotelService = new \AlFuttaim\Modules\Hotels\Services\HotelsService();
       
        $inWhere=[["provider",["BestHotels"]]];

        $hotels = $hotelService->getHotels($inWhere);

        json_decode($hotels);
        $success = (json_last_error() == JSON_ERROR_NONE)? true : false;
        $this->assertTrue($success);
    }

    public function testCrazyHotels() {
        // GET ALL CRAZY HOTELS
        $hotelService = new \AlFuttaim\Modules\Hotels\Services\HotelsService();
       
        $inWhere=[["provider",["CrazyHotels"]]];

        $hotels = $hotelService->getHotels($inWhere);
        
        json_decode($hotels);
        $success = (json_last_error() == JSON_ERROR_NONE)? true : false;
        $this->assertTrue($success);
    }
}