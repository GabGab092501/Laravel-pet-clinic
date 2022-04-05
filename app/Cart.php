<?php

namespace App;

class Cart
{
    public $services = null;
    public $totalCost = 0;

    public function __construct($oldService)
    {

        if ($oldService) {
            $this->services = $oldService->services;
            $this->totalCost = $oldService->totalCost;
        }
    }

    public function add($services, $id)
    {
        $addService = ['cost' => $services->cost, 'services' => $services];
        if ($this->services) {
            if (array_key_exists($id, $this->services)) {
                $addService = $this->services[$id];
            }
        }
        $addService['cost'] = $services->cost;
        $this->services[$id] = $addService;
        $this->totalCost += $services->cost;
    }

    public function removeService($id)
    {
        $this->totalCost -= $this->services[$id]['cost'];
        unset($this->services[$id]);
    }
}
