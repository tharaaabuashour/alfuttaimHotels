<?php
namespace AlFuttaim\Modules\Hotels\Models;
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation\Validator\PresenceOf as RequiredFields;
use Phalcon\Validation\Validator\InclusionIn as InclusionIn;

class Hotels extends \Phalcon\Mvc\Model 
{
   /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=36, nullable=true)
     */
    protected $name;

    /**
     *
     * @var string
     * @Column(type="string", length=36, nullable=true)
     */
    protected $provider;

    /**
     *
     * @var double
     * @Column(type="double", nullable=true)
     */
    protected $fare;

    /**
     *
     * @var double
     * @Column(type="double", nullable=true)
     */
    protected $discount;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $city;

    /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    protected $numberOfAdults;

      /**
     *
     * @var integer
     * @Column(type="integer", length=32, nullable=true)
     */
    protected $rate;


    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $createdAt;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $amenities;

    public $validationMessage;

    /**
     * Method to set the value of field id
     *
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field provider
     *
     * @param string $provider
     * @return $this
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Method to set the value of field fare
     *
     * @param double $fare
     * @return $this
     */
    public function setFare($fare)
    {
        $this->fare = $fare;

        return $this;
    }

    /**
     * Method to set the value of field city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Method to set the value of field numberOfAdults
     *
     * @param integer $numberOfAdults
     * @return $this
     */
    public function setNumberOfAdults($numberOfAdults)
    {
        $this->numberOfAdults = $numberOfAdults;

        return $this;
    }

    /**
     * Method to set the value of field rate
     *
     * @param integer $rate
     * @return $this
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Method to set the value of field discount
     *
     * @param double $discount
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }


    /**
     * Method to set the value of field createdAt
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Method to set the value of field amenities
     *
     * @param string $amenities
     * @return $this
     */
    public function setAmenities($amenities)
    {
        $this->amenities = $amenities;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field provider
     *  
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Returns the value of field fare
     *
     * @return double
     */
    public function getFare()
    {
        return $this->fare;
    }

    /**
     * Returns the value of field city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Returns the value of field numbeOfAdults
     *
     * @return string
     */
    public function getNumbeOfAdults()
    {
        return $this->numbeOfAdults;
    }

    /**
     * Returns the value of field rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Returns the value of field createdAt
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Returns the value of field discount
     *
     * @return double
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Returns the value of field amenities
     *
     * @return string
     */
    public function getAmenities()
    {
        return $this->amenities;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("hotels");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'hotels';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Hotels[]|Hotels|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Hotels|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'provider' => 'provider',
            'fare' => 'fare',
            'city' => 'city',
            'created_at' => 'createdAt',
            'number_of_adults' => 'numberOfAdults',
            'rate' => 'rate',
            'discount' => 'discount',
            'amenities' => 'amenities'
        ];
    }
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
        [
            "name"
        ],
        new RequiredFields(
            [
            "message" => [
                    "name"  => "Hotel Name is required"
                ],
            ]
        ));
        
        $validator->add(
            [
                "rate"
            ],
            new InclusionIn([
                "message"   => "Hotel Rate should be between 1 & 5",
                "domain"    => [1, 2, 3, 4, 5],
                "allowEmpty" => true,
            ])
        );

        return $this->validate($validator);
    }

}
