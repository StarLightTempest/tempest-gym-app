<?php

namespace App\Controller;

use App\Entity\Machines;
use App\Form\MachinesType;
use App\Repository\MachinesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/machines')]
class MachinesController extends AbstractController
{
    private Filesystem $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    #[Route('/', name: 'app_machines_index', methods: ['GET'])]
    public function index(MachinesRepository $machinesRepository): Response
    {
        $allMachines = $machinesRepository->findAll();

        return $this->render('machines/index.html.twig', [
            'machines' => $allMachines,
        ]);
    }

    #[Route('/new', name: 'app_machines_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $machine = new Machines();
        $form = $this->createForm(MachinesType::class, $machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($machine);
            $entityManager->flush();

            $pictureFile = $form->get('pictureFile')->getData();

            if ($pictureFile) {
                $this->handleFileUpload($pictureFile, $machine, $entityManager);
            }

            return $this->redirectToRoute('app_machines_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('machines/new.html.twig', [
            'machine' => $machine,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_machines_show', methods: ['GET'])]
    public function show(Machines $machine): Response
    {
        return $this->render('machines/show.html.twig', [
            'machine' => $machine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_machines_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Machines $machine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MachinesType::class, $machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictureFile = $form->get('pictureFile')->getData();

            if ($pictureFile) {
                $this->handleFileUpload($pictureFile, $machine, $entityManager);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_machines_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('machines/edit.html.twig', [
            'machine' => $machine,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_machines_delete', methods: ['POST'])]
    public function delete(Request $request, Machines $machine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$machine->getId(), $request->request->get('_token'))) {
            $this->deleteFile($machine);
            $entityManager->remove($machine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_machines_index', [], Response::HTTP_SEE_OTHER);
    }

    private function handleFileUpload($pictureFile, Machines $machine, EntityManagerInterface $entityManager): void
    {
        $this->deleteFile($machine);

        $newFilename = $machine->getId().'.'.$pictureFile->guessExtension();

        try {
            $pictureFile->move(
                $this->getParameter('machines_directory'),
                $newFilename
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        $machine->setPictureURL('assets/machines/' . $newFilename);
        $entityManager->flush();
    }

    private function deleteFile(Machines $machine): void
    {
        $oldFilename = $machine->getPictureURL();
        if ($oldFilename && $this->filesystem->exists($this->getParameter('machines_directory') . '/' . $oldFilename)) {
            $this->filesystem->remove($this->getParameter('machines_directory') . '/' . $oldFilename);
        }
    }
}