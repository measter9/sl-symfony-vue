<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Experience;
use App\Entity\User;
use App\Model\UserDTO;
use Doctrine\ORM\EntityManagerInterface;

use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class UserController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function users(EntityManagerInterface $entityManager): JsonResponse
    {
        return new JsonResponse($entityManager->getRepository(User::class)->findAll());
    }

    #[Route('/user', name: 'create_user', methods: 'POST')]
    public function createUser(EntityManagerInterface $entityManager, #[MapRequestPayload] UserDTO $user): JsonResponse
    {
        $u = new User();

//          user setup
        if((strlen($user->getFirstname())==0) || (strlen($user->getLastname())==0)){
            return new JsonResponse("user data not valid",400);
        }
        $u->setName($user->getFirstname());
        $u->setSurrname($user->getLastname());

        $userDate = date_create($user->getBirthdate());
        if(($userDate >= new \DateTime())){
            return new JsonResponse("invalid birthdate", 400);
        }
        $u->setBirthDate(date_create($user->getBirthdate()));

//        contact setup
        $c = new Contact();
        $c->setUser($u);
        $phoneRegex = "~\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$~";
        $emailRegex = "~\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b~";
        if(!preg_match($phoneRegex,$user->getPhone()) || !preg_match($emailRegex,$user->getEmail())){
            return new JsonResponse("invalid contact data", 400);
        }
        $c->setPhone($user->getPhone());
        $c->setEmail($user->getEmail());

        $u->setContact($c);

//        experience setup
        foreach ($user->getExperience() as $item) {
            $e = new Experience();
            if((strlen($item["position"]) == 0) || (strlen($item["company"]) == 0)){
                return new JsonResponse("invalid experience data", 400);
            }
            $e->setPosition($item["position"]);
            $e->setCompanyName($item["company"]);

            $statDate = date_create($item["startDate"]);
            $endDate = date_create($item["endDate"]);

            if(
                ($statDate < $endDate) &&
                $statDate && $endDate
            )
            {
            $e->setStartDate($statDate);
            $e->setEndDate($endDate);
            $e->setUser($u);

            $u->addExperienceList($e);}
            else{
                return new JsonResponse("invalid experience date", 400);
            }
        }

        $entityManager->persist($c);
        $entityManager->persist($u);

        $entityManager->flush();

        return new JsonResponse($u);
    }
}
