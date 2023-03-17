<?php
/**
 * Class Budget represents a budget object with methods to calculate the minimum value fee and the maximum value product.
 */

 include_once 'CONSTANTS.php';
 include_once 'Vehicle.php';

class Budget
{
    protected $totalAmount;


    /**
     * Budget constructor.
     *
     * @param float $totalAmount The total amount of the budget.
     */

    public function __construct(float $totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    public function getMinValueFee(): float
    {
        return STORAGE_FEE + BASIC_USER_FEE_MINIMUM;
    }

     /**
     * Returns the minimum value fee for the budget.
     *
     * @return bool|array Returns true if the budget meets the requirement or an array with the report data if it doesn't.
     */
    public function validateMinValue(): bool|array
    {
        if ($this->totalAmount < $this->getMinValueFee()) {
            $vehicle = new Vehicle(0);            
            return $this->getResult($vehicle);
        }
        return true;
    }

    /**
     * Calculate the maximum offer you can buy the vehicle with your budget.
     * @return array|bool Returns an array with the report data if a valid maximum value product is found or false if not.
     */
    public function getMaxOffer(): array|bool
    {
        if (!$this->validateMinValue()) {
            return false;
        }
        $vehiclePriceLimit = $this->totalAmount - $this->getMinValueFee();
        for ($maxAmountVehicle = $vehiclePriceLimit; $maxAmountVehicle > 0; $maxAmountVehicle -= 0.01) { //0.01 is the minimum decrement for more precision
            $vehicle = new Vehicle($maxAmountVehicle);
            //echo 'max=' . $maxAmountVehicle . '<br>';
            $totalTaxes = $vehicle->getTotalTaxes();
            $maxAmountVehicleConImpuestos = round($maxAmountVehicle + $totalTaxes, 2);
            if ($maxAmountVehicleConImpuestos <= $this->totalAmount) {                
                return $this->getResult($vehicle);
            }
        }
        return $this->getResultEmpty();
    }

    /**
     * It generates a report with the rate data and the maximum value you can bid with the budget.
     * @param Vehicle $vehicle The vehicle object that maximizes the value of the purchase.
     * @return array An array with the report data.
     */
    protected function getResult(Vehicle $vehicle): array
    {

       return   [  'budget'         => round($this->totalAmount, 2),
                   'TotalAmount'    => round($vehicle->getAmount(), 2),
                   'BasicFee'       => round($vehicle->getBasicFee(), 2),
                   'SpecialFee'     => round($vehicle->getSellersSpecialFee(), 2),
                   'AssociationFee' => round($vehicle->getAssociationFee($vehicle->getAmount()), 2),
                   'Storage'        => $vehicle->getStorageFee(),
               ];
    }

    /**
     * Return empty array
     */
    protected function getResultEmpty(): array
    {

       return   [  'budget'         => round($this->totalAmount, 2),
                   'TotalAmount'    => round(0, 2),
                   'BasicFee'       => round(0, 2),
                   'SpecialFee'     => round(0, 2),
                   'AssociationFee' => round(0, 2),
                   'Storage'        => 0,
               ];
    }
  }