<?php

namespace App\Controller;

use App\DBAL\Type\OperatorType;
use App\Form\CalculatorType;
use App\Service\Calculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route(path: '/calculator', name: 'calculator')]
    public function calculator(Request $request): Response
    {
        $form = $this->createForm(CalculatorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operator     = $form->getData()['operator'];
            $firstNumber  = $form->getData()['firstNumber'];
            $secondNumber = $form->getData()['secondNumber'];

            $result = Calculator::calculate($operator, $firstNumber, $secondNumber);
        }

        return $this->render('calculator/index.html.twig', [
            'form'   => $form,
            'result' => $result ?? ''
        ]);
    }
}