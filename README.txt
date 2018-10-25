Owner: Tharaa Abu Ashour
Email: tharaaabuashour@gmail.coml
phoneNumber: 00962790041475

This project is used to list available hotels regardless best & crazy hotel
The project is build using PHP - Phalcon Framework (Full Structure)
Database is : Postgres 9.5


API ROOT PATH = /localhost/alfuttaim
ex. http://localhost/alfuttaim/availableHotels?fromDate=2018-10-23&toDate=2018-10-26&city=AMM

TO run project, you should do the following:
1. change database config in this file: \alfuttaim\app\config\infra\db.php
2. You need to execute these queries:
	CREATE table hotels (
		id serial primary key,
		name text not null,
		provider enum_hotel_providers, 
		fare float,
		city character varying(3),
		number_of_adults integer,
		rate integer default 0,
		discount float,
		amenities jsonb, 
		created_at timestamp without time zone default Now()
	);

	CREATE INDEX hotels_provider ON hotels (provider) ;

	CREATE TYPE enum_hotel_providers AS ENUM ('BestHotels', 'CrazyHotels');


All the apis routed in this file: \alfuttaim\app\config\routes.php

Notes:
1. We have one Model called "hotels", contain crazy & best hotels
2. We have Three Controllers:
	- HotelsController (Generic Controller)
	- BestHotelsController 
	- CrazyHotelsController

3. We have Three Views:
	- HotelsView (Generic View)
	- BestHotelsView 
	- CrazyHotelsView

3. All the classes registered in this file: \alfuttaim\app\modules\hotels\Module.php

4. TO run unitTest, Go to "alfuttaim" directoy and run this command: 
	./vendor/bin/phpunit .\tests\Test\UnitTest.php

	NOTE: You should to install composer and update these dependencies before execute UnitTest
	
	
APIS:
1. GET AVAILABLE HOTELS
	 http://localhost/alfuttaim/availableHotels?fromDate=2018-10-23&toDate=2018-10-26&city=AMM
		Request:
			- fromDate: ISO_LOCAL_DATE
			- toDate: ISO_LOCAL_DATE
			- city: IATA code (AUH)
			- numberOfAdults: integer number
		Response:
			- provider: name of the provider (“BestHotels” or “CrazyHotels”)
			- hotelName: Name of the hotel
			- fare: fare per night
			- amenities: array of strings
		
		METHOD: GET

2. GET BEST HOTELS
	 http://localhost/alfuttaim/bestHotels?city=AMM&fromDate=2018-10-23
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
		
		METHOD: GET

3. GET Crazy HOTELS
		http://localhost/alfuttaim/crazyHotels?city=AMM&from=2018-10-23T23:15:30&adultsCount=4
        
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
		
		METHOD: GET

4.  CREATE BEST HOTEL:
		- CREATE BEST HOTELS
			API:	http://localhost/alfuttaim/bestHotels
			
			METHOD: POST
			
			PARAMS: {"name":"HOLIDAY INN","fare":100.99,"city":"AMM","numberOfAdults":"1","rate":"4","discount":0.05,"amenities":{"amenities":["SPA", "GYM"]}}]}

		1. CREATE CRAZY HOTEL:
			API:    http://localhost/alfuttaim/crazyHotels
			METHOD: POST
			PARAMS: {"name":"Gardens Hotel","fare":50,"city":"AMM","numberOfAdults":"0","rate":"3","discount":0.05,"amenities":{"amenities":["GYM"]}}]}


5.  UPDATE HOTELS
        1. UPDATE BEST HOTEL:
            API:    http://localhost/alfuttaim/bestHotels/1

            METHOD: PUT

            PARAMS: {"name":"HOLIDAY INN - NEW"}

        2. UPDATE CRAZY HOTEL:
            API:    http://localhost/alfuttaim/crazyHotels/2
			
            METHOD: PUT

            PARAMS: {"name":"Gardens Hotel","fare":50,"city":"AMM","numberOfAdults":"0","rate":"3","discount":0.05,"amenities":{"amenities":["GYM"]}}]}


6. DETELE HOTELS
        1. DETELE BEST HOTEL:
            API:    http://localhost/alfuttaim/bestHotels/1

            METHOD: DELETE

        2. DETELE CRAZY HOTEL:
            API:    http://localhost/alfuttaim/crazyHotels/2

            METHOD: DELETE