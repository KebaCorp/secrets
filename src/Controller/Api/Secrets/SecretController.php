<?php

namespace App\Controller\Api\Secrets;

use App\Secrets\Service\SecretServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SecretController.
 *
 * @package App\Controller\Api\Secrets
 */
class SecretController extends AbstractController
{
    /**
     * Secret service.
     *
     * @var SecretServiceInterface
     */
    private SecretServiceInterface $secretService;

    /**
     * SecretController constructor.
     *
     * @param SecretServiceInterface $secretService
     */
    public function __construct(SecretServiceInterface $secretService)
    {
        $this->secretService = $secretService;
    }

    /**
     * Create secret.
     *
     * @Route("/create", methods={"POST"})
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $secret = $this->secretService->create($data['secretTypeId'], $data['salt'], $data['length']);

        return $this->json(['secret' => $secret]);
    }
}
