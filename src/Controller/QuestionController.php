<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Question;
use App\Repository\QuestionRepository;


class QuestionController extends AbstractController
{
    private $logger;
    private $isDebug;

    public function __construct(LoggerInterface $logger, bool $isDebug)
    {
        $this->logger = $logger;
        $this->isDebug = $isDebug;
    }


    /**
     * @Route("/", name="app_homepage")
     */

    public function homepage(QuestionRepository $repository) //EntityManagerInterface $entityManager
    {
        //$repository = $entityManager->getRepository(Question::class);

        //$questions = $repository->findAllAskedOrderedByNewest();
        
        $questions = $repository->findAllAskedOrderedByVoteNumbers();

        return $this->render('question/homepage.html.twig', [
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/questions/new")
     */

    public function new(EntityManagerInterface $entityManager)
    {

        $question = new Question();

        $question->setName('What is a transistor and how it works?')
            ->setSlug('what-is-a-transistor-'.rand(0, 1000))
            ->setQuestion(<<<EOF
What is the purpose of a transistor and how it works?
EOF
            );

        $question->setAskedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));

        $question->setVotes(rand(-10, 10));
        
        $entityManager->persist($question);
        $entityManager->flush();

        
        return new Response('The question was automatically generated from the code and is number #'.$question->getId().', slug: '.$question->getSlug());

    }
    
    /**
     * @Route("/questions/{slug}", name="app_question_show")
     */
    
    public function show(Question $question)
    {
        if ($this->isDebug) {
            $this->logger->info('We are in debug mode!');
        }

        $answers = [
            'That component is nice to `have`.',
            'It\'s an integrated part of a device',
            'Might need id sometimes',
        ];

        return $this->render('question/show.html.twig', [
            'question' => $question,
            'answers' => $answers,
        ]);
    }
    
    /**
     * @Route("/questions/{slug}/vote", name="app_question_vote", methods="POST")
     */
    public function questionVote(Question $question, Request $request, EntityManagerInterface $entityManager)
    {
        $direction = $request->request->get('direction');
        if ($direction === 'up') {
            $question->upVote();
        } elseif ($direction === 'down') {
            $question->downVote();
        }
        
        $entityManager->flush();

        return $this->redirectToRoute('app_question_show', [
            'slug' => $question->getSlug()
        ]);
    }
    
}
