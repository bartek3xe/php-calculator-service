<?php

namespace App\Controller;

use App\Form\CalculatorType;
use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    public function __construct(private readonly CalculatorService $calculator)
    {
    }

    #[Route(path: '/', name: 'calculator')]
    public function calculator(Request $request): Response
    {
        $form = $this->createForm(CalculatorType::class);
        $form->handleRequest($request);

        [$formResult, $message] = $this->handleForm($form);

        return $this->render('calculator/index.html.twig', [
            'form'    => $form,
            'result'  => $formResult ?? '',
            'message' => $message,
        ]);
    }

    private function handleForm(FormInterface $form): ?array
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $operator     = $form->getData()['operator'];
            $firstNumber  = $form->getData()['firstNumber'];
            $secondNumber = $form->getData()['secondNumber'];

            return [$this->calculator->calculate($operator, $firstNumber, $secondNumber, $message), $message];
        }

        return null;
    }
}
