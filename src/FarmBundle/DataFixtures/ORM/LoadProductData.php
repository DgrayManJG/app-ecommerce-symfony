<?php
namespace FarmBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FarmBundle\Entity\Product;

class LoadProductData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
      $faker = \Faker\Factory::create('fr_FR');

      $categoryRepository = $em->getRepository("FarmBundle:Category");
      $categories = $categoryRepository->findAll();

      $userRepository = $em->getRepository("FarmBundle:User");
      $userFarmer = $userRepository->findUserByRoles();

      for ($i=0; $i < 50; $i++) {

        // créer une instance d'un produit
        $product = new Product();

        //l'hydrate
        $product->setName($faker->word());
        $product->setPrice($faker->randomFloat(NULL, 0, 100));
        $product->setQuantity($faker->numberBetween(1, 50));
        $product->setDescription($faker->realText(200, 2));
        $product->setIsActive($faker->boolean(90));
        $product->setDateCreated(new \DateTime());
        shuffle($userFarmer);
        $product->setUser($userFarmer[0]);

        $category = $faker->randomElement($categories);
        $product->setCategory($category);

        //on demande a doctrine de sauvegarder notre instance
        $em->persist($product);
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
        return 3;
    }
}
