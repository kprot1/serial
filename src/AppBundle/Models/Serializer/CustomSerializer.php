<?php

namespace AppBundle\Models\Serializer;

use AppBundle\Entity\Input;
use AppBundle\Entity\Output;
use AppBundle\Models\Normalizer\OutputNormalizer;use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CustomSerializer
{
    /**
     * @var \Symfony\Component\Serializer\Serializer
     */
    private $serializer;
    
    public function __construct()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
    
        $this->serializer = new Serializer($normalizers, $encoders);
    }
    
    /**
     * @param string $xmlInput
     *
     * @return string
     */
    public function getXmlOutput($xmlInput)
    {
        $input = $this->serializer->deserialize($xmlInput, Input::class, 'xml');
        $output = new Output();
        $output->setSumResult($this->getSumResult($input->getSums()['decimal'], $input->getK()));
        $output->setMulResult($this->getMulResult($input->getMuls()['int']));
        $output->setSortedInputs($this->getSortedInputs($input->getSums()['decimal'],$input->getMuls()['int']));
        
        return $this->getNormalizeXmlOutput($output);
    }
    
    /**
     * @param string $jsonInput
     *
     * @return string
     */
    public function getJsonOutput($jsonInput)
    {
        $input = $this->serializer->deserialize($jsonInput, Input::class, 'json');
        $output = new Output();
        $output->setSumResult($this->getSumResult($input->getSums(), $input->getK()));
        $output->setMulResult($this->getMulResult($input->getMuls()));
        $output->setSortedInputs($this->getSortedInputs($input->getSums(),$input->getMuls()));
        
        return $this->serializer->serialize($output, 'json');
    }
    
    /**
     * Подсчитывает SumResult
     *
     * @param array $sums
     * @param int $k
     * @return int
     */
    private function getSumResult($sums, $k)
    {
        $result = 0;
    
        foreach ($sums as $sum) {
            $result += $sum;
        }
    
        return $result === 0 ? null : $result * $k;
    }
    
    /**
     * Подсчитывает MulResult
     *
     * @param array $muls
     * @return int|null
     */
    private function getMulResult($muls)
    {
        $result = 1;
    
        foreach ($muls as $mul) {
            $result *= $mul;
        }
        
        if ($result === 1) {
            return null;
        }
        
        return $result;
    }
    
    
    /**
     * Сортирует элементы Sum и Mul
     *
     * @param array $sums
     * @param array $muls
     * @return array
     */
    private function getSortedInputs($sums, $muls)
    {
        $sortedInputs = array_merge($sums, $muls);
        sort($sortedInputs);
        
        return $sortedInputs;
    }
    
    /**
     * @param Output $output
     *
     * @return string
     */
    private function getNormalizeXmlOutput($output)
    {
        $outputNormalizer = new OutputNormalizer();
        
        $outputNormalizer->addOutputStart();
        $outputNormalizer->addSumResult($output->getSumResult());
        $outputNormalizer->addMulResult($output->getMulResult());
        $outputNormalizer->addSortedInputs($output->getSortedInputs());
        $outputNormalizer->addOutputEnd();
        
        return $outputNormalizer->getResult();
    }
}
