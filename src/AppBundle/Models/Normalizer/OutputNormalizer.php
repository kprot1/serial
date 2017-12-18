<?php
    
namespace AppBundle\Models\Normalizer;

class OutputNormalizer
{
    const OUTPUT_ATTRIBUTE = 'Output';
    const SUMRESULT_ATTRIBUTE = 'SumResult';
    const MULRESULT_ATTRIBUTE = 'MulResult';
    const SORTED_INPUTS_ATTRIBUTE = 'SortedInputs';
    const DECIMAL_ATTRIBUTE = 'decimal';
    private $result = '';
    
    public function addOutputStart()
    {
        $this->result .= '<'.self::OUTPUT_ATTRIBUTE.'>';
        return $this;
    }
    
    public function addSumResult($sumResult)
    {
        $this->result .= '<'.self::SUMRESULT_ATTRIBUTE.'>';
        $this->result .= (string)$sumResult;
        $this->result .= '</'.self::SUMRESULT_ATTRIBUTE.'>';
        return $this;
    }
    
    public function addMulResult($mulResult)
    {
        $this->result .= '<'.self::MULRESULT_ATTRIBUTE.'>';
        $this->result .= (string)$mulResult;
        $this->result .= '</'.self::MULRESULT_ATTRIBUTE.'>';
        return $this;
    }
    
    /**
     * @param array $sortedInputs
     */
    public function addSortedInputs($sortedInputs)
    {
        $this->result .= '<'.self::SORTED_INPUTS_ATTRIBUTE.'>';
        foreach ($sortedInputs as $sortedInput) {
            $this->addDecimal($sortedInput);
        }
        $this->result .= '</'.self::SORTED_INPUTS_ATTRIBUTE.'>';
    }
    
    public function addOutputEnd()
    {
        $this->result .= '</'.self::OUTPUT_ATTRIBUTE.'>';
        return $this;
    }
    
    public function getResult()
    {
        return $this->result;
    }
    
    private function addDecimal($value)
    {
        $this->result .= '<'.self::DECIMAL_ATTRIBUTE.'>';
        $this->result .= (string)$value;
        $this->result .= '</'.self::DECIMAL_ATTRIBUTE.'>';
        return $this;
    }
}
