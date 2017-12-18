<?php

namespace AppBundle\Controller;

use AppBundle\Models\Serializer\CustomSerializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /*
     * @throws \Symfony\Component\Config\Definition\Exception\Exception
     * @throws \LogicException
     */
    public function indexAction(Request $request)
    {
        $content = $request->getContent();
        $type = array_shift(explode("\r\n", $content));
        
        $serializer = new CustomSerializer();
        
        if ($type === 'Xml') {
            return $this->render('default/output.html.twig', [
                'type' => $type,
                'output' => $serializer->getXmlOutput($this->getContentWithoutType($content))
            ]);
        }
        if ($type === 'Json') {
            return $this->render('default/output.html.twig', [
                'type' => $type,
                'output' => $serializer->getJsonOutput($this->getContentWithoutType($content))
            ]);
        }
        
        throw new Exception('Неизвестный тип сериализации');
    }
    
    /**
     * Возвращает входную строку без типа сериализации
     *
     * @param $content
     * @return string
     */
    private function getContentWithoutType($content)
    {
        $content = explode("\r\n", $content);
        $type = array_shift($content);
        
        return implode('', $content);
    }
}
