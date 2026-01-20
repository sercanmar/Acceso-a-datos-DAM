<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class CentreRepository extends EntityRepository
{
    public function findCentreByProvincia($provincia){
        $consulta=$this->getEntityManager()->getConnection()->prepare("
         SELECT c.codi, c.centre,p.nom 
         FROM centre c 
         INNER JOIN provincia p ON p.id = c.provincia_id 
         WHERE p.nom = :provincia 
          ");
        $consulta->bindValue("provincia",$provincia);
        $resultado = $consulta->executeQuery();
        return $resultado->fetchAllAssociative();



    }
}