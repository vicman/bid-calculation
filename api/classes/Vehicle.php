<?php
/**
 * Class Vehicle represents a vehicle object with methods to calculate taxes and fees.
 */
include_once 'CONSTANTS.php';
class Vehicle
{
    protected float $price;
  
     /**
     * Vehicle constructor.
     *
     * @param float $price The price of the vehicle.
     */

    public function __construct(float $price)
    {
        $this->price = $price;
    }


   /**
     * Returns the price of the vehicle.
     *
     * @return float The price of the vehicle.
     */
    public function getAmount()
    {
      return $this->price;
    }

    /**
     * Returns the storage fee for the vehicle.
     *
     * @return int The storage fee for the vehicle.
     */

    public function getStorageFee():int
    {
      return STORAGE_FEE;
    }

    /**
     * Calculates the basic fee for the vehicle.
     *
     * @return float The basic fee for the vehicle.
     */
    public function getBasicFee(): float
    {
        $basicFee = round($this->price * BASIC_USER_FEE_PERCENTAGE, 2);
        if ($basicFee == 0) {
            return $basicFee;
        }
        $basicFee = max($basicFee, BASIC_USER_FEE_MINIMUM);
        $basicFee = min($basicFee, BASIC_USER_FEE_MAXIMUM);
        return $basicFee;
    }

    /**
     * The added costs for the association based on the price of the vehicle:
    * $5 for an amount between $1 and $500
    * $10 for an amount greater than $500 up to $1000
    * $15 for an amount greater than $1000 up to $3000
    * $20 for an amount over $3000
     *
     * @param float $amount The amount used to calculate the association fee.
     *
     * @return float The association fee for the vehicle.
     */

     public function getAssociationFee(float $amount): float 
     {

        $amount = round($amount,2);
          if ($amount >= 3000) {
              return 20;
          } elseif ($amount >= 1000) {
              return 15;
          } elseif ($amount > 500) {
              return 10;
          } elseif ($amount >= 1) {
              return 5;
          } else {
              return 0;
          }
    }
  

    /**
     * Calculates the seller's special fee for the vehicle.
     *
     * @return float The seller's special fee for the vehicle.
     */

    public function getSellersSpecialFee(): float
    {
        return round($this->price * SELLER_SPECIAL_FEE_PERCENTAGE, 2);
    }

    /**
     * Calculates the total taxes for the vehicle.
     *
     * @return float The total taxes for the vehicle.
     */
    public function getTotalTaxes(): float
    {
      
        $basicFee = $this->getBasicFee();
        $associationFee = $this->getAssociationFee( $this->price);
        $specialFee = $this->getSellersSpecialFee();
        return STORAGE_FEE + $basicFee + $associationFee + $specialFee;
    }
}