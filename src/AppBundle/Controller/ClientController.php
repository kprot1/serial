<?php

namespace AppBundle\Controller;

use AppBundle\Models\Serializer\CustomSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function pingAction(Request $request)
    {
        try {
            $response = $this->forward('AppBundle:Server:ping', []);
        } catch (Exception $exception) {
            $response = new Response('Сервер недоступен.', 521);
        }
        
        return $response;
    }
    
    /**
     * @param Request $request
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function getInputDataAction(Request $request)
    {
        $pingResponse = $this->pingAction($request);
        
        if ($pingResponse->getStatusCode() !== Response::HTTP_OK) {
            return $this->getErrorResponse();
        }
        
        $jsonInput = $this->forward('AppBundle:Server:postInputData', [])->getContent();
        
        return new Response($jsonInput);
    }
    
    /**
     * @param Request $request
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function writeAnswerAction(Request $request)
    {
        $serializer = new CustomSerializer();
        $jsonInput = $this->getInputDataAction($request)->getContent();
        
        $jsonOutput = $serializer->getJsonOutput($jsonInput);
        
        $outputRequest = $this->createRequestWithContent($jsonOutput);
        
        $response = $this->forward('AppBundle:Server:getAnswer', ['request' => $outputRequest]);
        
        return $response;
    }
    
    /**
     * @return Response
     * @throws \InvalidArgumentException
     */
    private function getErrorResponse()
    {
        return new Response('Сервер недоступен', 521);
    }
    
    /**
     * Создание пустого Request, с заполненным контентом
     *
     * @param $content
     * @return Request
     */
    private function createRequestWithContent($content)
    {
        return new Request(
            $_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER,
            $content
        );
    }
}
