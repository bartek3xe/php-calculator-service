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

        $formResult = $this->handleForm($form);

        return $this->render('calculator/index.html.twig', [
            'form'   => $form,
            'result' => $formResult ?? ''
        ]);
    }

    private function handleForm(FormInterface $form): ?int
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $operator     = $form->getData()['operator'];
            $firstNumber  = $form->getData()['firstNumber'];
            $secondNumber = $form->getData()['secondNumber'];

            return $this->calculator->calculate($operator, $firstNumber, $secondNumber);
        }

        return null;
    }
}
