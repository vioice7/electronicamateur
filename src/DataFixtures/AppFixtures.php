<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\Fixture;

use App\Factory\QuestionFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $question = new Question();
        $question->setName('What is a 555 timer?')
            ->setSlug('what-is-a-555-timer')
            ->setQuestion(<<<EOF
What is a 555 timer and how can I use it on a diagram?
EOF
            );
        //if (rand(1, 10) > 2) {
        $question->setAskedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        //}
        $question->setVotes(rand(-10, 10));
        $manager->persist($question);
        $manager->flush();



        /* ---- */
        
        $question = new Question();
        $question->setName('What is a preamplifier?')
            ->setSlug('what-is-a-preamplifier')
            ->setQuestion(<<<EOF
What is a preamplifier and how can I make one?
EOF
            );
        //if (rand(1, 10) > 2) {
        $question->setAskedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        //}
        $question->setVotes(rand(-10, 10));
        $manager->persist($question);
        $manager->flush();
        

        /* ---- */

        $question = new Question();
        $question->setName('How does a speaker work?')
            ->setSlug('how-does-a-speaker-work')
            ->setQuestion(<<<EOF
How does a speker work if you connect it to an amplifier?
EOF
            );
        //if (rand(1, 10) > 2) {
        $question->setAskedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        //}
        $question->setVotes(rand(-10, 10));
        $manager->persist($question);
        $manager->flush();


        /*
        QuestionFactory::new()->createMany(12);

        QuestionFactory::new()
                ->unpublished()
                ->createMany(5);
        */ 

    }
}