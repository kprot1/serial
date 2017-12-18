<?php

namespace AppBundle\Entity;

/**
 * Class Output
 * @package AppBundle\Entity
 */
class Output
{
    /**
     * @var
     */
    public $SumResult;
    
    /**
     * @var
     */
    public $MulResult;
    
    /**
     * @var
     */
    public $SortedInputs;
    
    /**
     * @return mixed
     */
    public function getSumResult()
    {
        return $this->SumResult;
    }
    
    /**
     * @param mixed $SumResult
     */
    public function setSumResult($SumResult)
    {
        $this->SumResult = $SumResult;
    }
    
    /**
     * @return mixed
     */
    public function getMulResult()
    {
        return $this->MulResult;
    }
    
    /**
     * @param mixed $MulResult
     */
    public function setMulResult($MulResult)
    {
        $this->MulResult = $MulResult;
    }
    
    /**
     * @return mixed
     */
    public function getSortedInputs()
    {
        return $this->SortedInputs;
    }
    
    /**
     * @param mixed $SortedInputs
     */
    public function setSortedInputs($SortedInputs)
    {
        $this->SortedInputs = $SortedInputs;
    }
    
    
}
