<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServerController extends Controller
{
    private $jsonInput = '{"K":10,"Sums":[1.01,2.02],"Muls":[1,4]}';
    private $jsonOutput = '{"SumResult":30.3,"MulResult":4,"SortedInputs":[1,1.01,2.02,4]}';
    
    /**
     * @param Request $request
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function pingAction(Request $request)
    {
        return new Response('HttpStatusCode.Ok (200)');
    }
    
    /**
     * @param Request $request
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function postInputDataAction(Request $request)
    {
        return new Response($this->jsonInput);
    }
    
    /**
     * @param Request $request
     * @return Response
     * @throws \LogicException
     */
    public function getAnswerAction(Request $request)
    {
        $jsonOutput = $request->getContent();
        
        if ($jsonOutput === $this->jsonOutput) {
            return new Response('Ответ правильный');
        }
        
        return new Response('Ответ неверный');
    }
    
    /**
     * @param Request $request
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function stopAction(Request $request)
    {
        return new Response('Сервер остановлен');
    }
}
