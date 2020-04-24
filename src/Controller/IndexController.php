<?php

namespace App\Controller;

use App\Entity\Meme;
use App\Form\MemeType;
use App\Repository\MemeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class IndexController extends AbstractController implements ServiceSubscriberInterface
{
    public static function getSubscribedServices(): array
    {
        return array_merge(parent::getSubscribedServices(), [
            EntityManagerInterface::class,
            MemeRepository::class,
        ]);
    }

    /**
     * @Route("/", name="index")
     */
    public function __invoke(Request $request): Response
    {
        $meme = new Meme();

        $form = $this->createForm(MemeType::class, $meme)
            ->add('save', SubmitType::class)
        ;

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $this->getEntityManager()->persist($meme);
            $this->getEntityManager()->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'memes' => $this->getMemeRepository()->findBy([], ['id' => 'DESC']),
        ]);
    }

    private function getEntityManager(): EntityManagerInterface
    {
        return $this->container->get(EntityManagerInterface::class);
    }

    private function getMemeRepository(): MemeRepository
    {
        return $this->container->get(MemeRepository::class);
    }
}
