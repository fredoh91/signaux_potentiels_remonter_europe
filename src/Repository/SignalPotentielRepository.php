<?php

namespace App\Repository;

use App\Entity\SignalPotentiel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SignalPotentiel>
 */
class SignalPotentielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SignalPotentiel::class);
    }



    public function listeTousSignaux(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = <<<'SQL'
                SELECT
                    dp.libelle_dmm_court,
                    dp.libelle_pole_court,
                    sp.eval_prenom,
                    sp.eval_nom,
                    sp.substance,
                    sp.dosage,
                    va.libelle as lib_voie_admin,
                    sp.signal_potentiel,
                    sp.origine_signal,
                    sp.numero_bnpv,
                    ma.libelle as lib_mecanisme_action,
                    e.libelle as lib_exposition,
                    i.libelle as lib_imputabilite,
                    l.libelle as lib_litterature,
                    ec.libelle as lib_essais_cliniques,
                    erp.libelle as lib_effet_rcpautre_pays,
                    de.libelle as lib_das_ermr,
                    sp.score,
                    sp.commentaire,
                    sp.created_at,
                    sp.updated_at
                FROM
                    signal_potentiel sp
                LEFT JOIN signaux_potentiels.direction_pole dp ON sp.direction_pole_id = dp.id
                LEFT JOIN signaux_potentiels.voie_admin va ON sp.voie_admin_id = va.id
                LEFT JOIN signaux_potentiels.mecanisme_action ma ON sp.mecanisme_action_id = ma.id
                LEFT JOIN signaux_potentiels.exposition e ON sp.exposition_id = e.id
                LEFT JOIN signaux_potentiels.imputabilite i ON sp.imputabilite_id = i.id
                LEFT JOIN signaux_potentiels.litterature l ON sp.litterature_id = l.id
                LEFT JOIN signaux_potentiels.essais_cliniques ec ON sp.essais_cliniques_id = ec.id
                LEFT JOIN signaux_potentiels.effet_rcpautre_pays erp ON sp.effet_rcpautre_pays_id = erp.id
                LEFT JOIN signaux_potentiels.das_ermr de ON sp.das_ermr_id = de.id
                SQL;

        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery();
        return $result->fetchAllAssociative();
    }



    //    /**
    //     * @return SignalPotentiel[] Returns an array of SignalPotentiel objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SignalPotentiel
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
