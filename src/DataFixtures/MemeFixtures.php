<?php

namespace App\DataFixtures;

use App\Entity\Meme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MemeFixtures extends Fixture
{
    private const MEMES = [
        'https://pbs.twimg.com/media/EVQE6oQUEAIVDUi?format=jpg',
        'https://pbs.twimg.com/media/EVVDTJSXQAMPCki?format=jpg',
        'https://pbs.twimg.com/media/EWDdgC7WAAALfIK?format=jpg',
        'https://pbs.twimg.com/media/EWNulhkWoAAVCI4?format=jpg',
        'https://pbs.twimg.com/media/EWWnaCxXQAA6bxZ?format=jpg',
        'https://pbs.twimg.com/media/EWXUyTCWAAAn5Ey?format=jpg',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MEMES as $memeLink) {
            $meme = new Meme();
            $meme->setLink($memeLink);

            $manager->persist($meme);
        }

        $manager->flush();
    }
}