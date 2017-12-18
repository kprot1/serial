<?php
namespace AppBundle\Entity;

class Input
{
    /**
     * @var
     */
    public $K;
    
    /**
     * @var
     */
    public $Sums;
    
    /**
     * @var
     */
    public $Muls;
    
    /**
     * @return mixed
     */
    public function getK()
    {
        return $this->K;
    }
    
    /**
     * @param mixed $K
     */
    public function setK($K)
    {
        $this->K = $K;
    }
    
    /**
     * @return mixed
     */
    public function getSums()
    {
        return $this->Sums;
    }
    
    /**
     * @param mixed $Sums
     */
    public function setSums($Sums)
    {
        $this->Sums = $Sums;
    }
    
    /**
     * @return mixed
     */
    public function getMuls()
    {
        return $this->Muls;
    }
    
    /**
     * @param mixed $Muls
     */
    public function setMuls($Muls)
    {
        $this->Muls = $Muls;
    }
}
