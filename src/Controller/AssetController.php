<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\AssetType;
use App\Repository\AssetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/asset")
 */
class AssetController extends AbstractController
{
    /**
     * @Route("/", name="asset_index", methods={"GET"})
     */
    public function index(AssetRepository $assetRepository): Response
    {
        return $this->render('asset/index.html.twig', [
            'assets' => $assetRepository->findAllByUser($this->getUser()),
        ]);
    }

    /**
     * @Route("/new", name="asset_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $asset = new Asset();
        $form = $this->createForm(AssetType::class, $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $asset->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($asset);
            $entityManager->flush();

            return $this->redirectToRoute('asset_index');
        }

        return $this->render('asset/new.html.twig', [
            'asset' => $asset,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="asset_show", methods={"GET"})
     */
    public function show(Asset $asset): Response
    {
        if ($asset->getUser() != $this->getUser()) {
            throw new AccessDeniedException();
        }

        return $this->render('asset/show.html.twig', [
            'asset' => $asset,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="asset_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Asset $asset): Response
    {
        if ($asset->getUser() != $this->getUser()) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(AssetType::class, $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asset_index', [
                'id' => $asset->getId(),
            ]);
        }

        return $this->render('asset/edit.html.twig', [
            'asset' => $asset,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="asset_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Asset $asset): Response
    {
        if ($asset->getUser() != $this->getUser()) {
            throw new AccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$asset->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($asset);
            $entityManager->flush();
        }

        return $this->redirectToRoute('asset_index');
    }
}
