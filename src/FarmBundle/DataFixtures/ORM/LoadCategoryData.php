<?php
namespace FarmBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FarmBundle\Entity\Category;

class LoadCategoryData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
       $categories = ["Fruits", "Légumes", "Viandes", "Fromages", "Epices et herbes", "Boissons", "Poissons"];

       foreach ($categories as $value) {
         $category = new Category();
         $category->setLabel($value);
         $em->persist($category);
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
        return 2;
    }
}
