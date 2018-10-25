<?php
/*
    THIS FILE IS USED TO CONTACT WITH DATABASE > CRUD
*/

namespace AlFuttaim\Modules\Hotels\Repositories;

use AlFuttaim\Modules\Hotels\Models\Hotels;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\DI;

class HotelsRepository
{
    
    public function save(Hotels $hotel)
    {
        if ($hotel->save() == false) {
            $messages = $hotel->getMessages();
            $result = [];
            foreach ($messages as $message) {
                $result[$message->getField()] = $message->getMessage();
            }
           return  $result;
        }
        return $hotel;
    }

    public function update($hotel)
    {
        $hotel->update();
        return $hotel;
    }
   
    public function delete($hotel) {
        return $hotel->delete();
    }

    public function getHotels($inWhere=[])
    {
        try {
            $query = Hotels::query()->columns(["*"]);                        
            if ($inWhere) {
                foreach ($inWhere as $condition) {
                    switch ($condition[0]) {
                        case "fromDate" :
                            $query->andWhere("createdAt>=:fromDate:", ["fromDate"=>$condition[1]]);
                        break;
                        case "toDate" :
                            $query->andWhere("createdAt<=:toDate:", ["toDate"=>$condition[1]]);
                        break;
                        default: 
                            $query->inWhere($condition[0], $condition[1]);
                        break;
                        
                    }
                }
            }
            $query->orderBy("rate desc");
            return $query->execute();
        }  catch (\Exception $e) {
            echo $e->getMessage();
        }
    }    
}
