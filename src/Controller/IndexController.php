<?php
// src/Controller/IndexController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CurrencyConverterService;
use App\Service\AssetsService;
use Symfony\Component\Security\Core\Security;

class IndexController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(AssetsService $assetsService, CurrencyConverterService $currencyConverterService, Security $security) : Response
    {
        $user = $security->getUser();

        $userAssets = $user->getAssets()->getValues();

        $currencyCodeTo = 'USD';

        $totalAssetsValue = $assetsService->totalAssetsValue($currencyConverterService, $userAssets, $currencyCodeTo);

        return $this->render('index.html.twig', ['totalAssetsValue' => $totalAssetsValue , 'currencyCodeTo' => $currencyCodeTo]);
    }


}