<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArchitecteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [];
        for($i=0;$i<5;$i++){
            $category = new Category();
            $category->setName('Catégorie'.$i);

            $manager->persist($category);
            $categories[] = $category;
        }

        $projects = [];
        for($i=0;$i<10;$i++){
            
            $project = new Project();
            $project->setTitle('Projet'.$i)
                    ->setYear(new \DateTime())
                    ->setClient('Jhon'.$i)
                    ->setCategory($categories[mt_rand(0,count($categories)-1)])
                    ->setDescription("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.")
                    ->setLocation('Vieux-Lille');

            $manager->persist($project);   
            $projects[] = $project;

        }

        //Admin user
        $user = new User();
        $user->setPassword('admin')
             ->setUsername('admin')
             ->setRoles(['ROLE_ADMIN']); 

        $manager->persist($user); 

        $manager->flush();
    }
}
