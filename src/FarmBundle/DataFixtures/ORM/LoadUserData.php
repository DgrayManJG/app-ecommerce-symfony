<?php
namespace FarmBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FarmBundle\Entity\User;

class LoadUserData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $userRepository = $em->getRepository("FarmBundle:User");
        $users = $userRepository->findAll();

        for ($i=0; $i < 50; $i++) {

            // créer une instance d'un produit
            $user = new User();

            $roles = array("ROLE_FARMER", "ROLE_CUSTOMER");

            //l'hydrate
            $user->setEmail($faker->email);
            $user->setUsername($faker->userName);
            $user->setPassword($faker->password);
            $user->setRoles($roles[mt_rand(0, count($roles) - 1)]);
            $user->setIsActive(true);
            $user->setDateCreated(new \DateTime());

            //on demande a doctrine de sauvegarder notre instance
            $em->persist($user);
        }

        //execute les requetes
        $em->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 1;
    }
}
