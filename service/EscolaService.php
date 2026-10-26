<?php
    namespace Service;

    use repository\EscolaRepository;
    use entity\Escola;

    class EscolaService {
        private EscolaRepository $repository;

        public function __construct(EscolaRepository $repository)
        {
            $this->repository = $repository;
        }

        public function procurarEscola(int $id): ?Escola {

            return $this->repository->buscarEscola($id);
        }

        public function procurarTodasEscolas(): array {
            return $this->repository->buscarTodasEscolas();
        }

        public function cadastrarEscola(Escola $escola): int {
            return $this->repository->criarEscola($escola);
        }

        public function atualizarEscola(Escola $escola): void {
            $this->repository->alterarEscola($escola);
        }
        
        public function deletarEscola(Escola $escola): void {
            $this->repository->deletarEscola($escola);
        }

    }
?>