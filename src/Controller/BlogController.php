<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;

#[Route('/blog')]
class BlogController extends AbstractController
{
    #[Route('/', name: 'app_blog_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Article::class);
        return $this->render('blog/index.html.twig', [
            "articles" => $repository->findBy([], ['id'=> 'DESC'])
        ]);
    }

    #[Route('/ajouter', name: 'app_blog_add')]
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('app_blog_index');
        }

        return $this->render('blog/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}/editer', name: 'app_blog_edit')]
    public function edit(int $id, ManagerRegistry $doctrine, Request $request): Response
    {
        $repository = $doctrine->getRepository(Article::class);
        $article = $repository->find($id);
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_blog_index');
        }

        return $this->render('blog/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}/supprimer', name: 'app_blog_delete')]
    public function delete(int $id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Article::class);

        $article = $repository->find($id);

        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('app_blog_index');
    }

    #[Route('/{id}', name: 'app_blog_show')]
    public function show(int $id, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Article::class);
        return $this->render('blog/show.html.twig', [
            'article' => $repository->find($id)
        ]);
    }
}
