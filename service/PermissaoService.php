<?php
    namespace service;
    
    use entity\Permissao;
    use repository\PermissaoRepository;

    class PermissaoService {
        private PermissaoRepository $repository;

        public function __construct(PermissaoRepository $repository) {
            $this->repository = $repository;
        }

        public function cadrastrarPermissao(Permissao $permissao): int {
            return $this->repository->criarPermissao($permissao);
        }

        public function ProcurarPermissao(int $id): ?Permissao {
            return $this->repository->buscarPermissao($id);
        }

        public function procurarTodasPermissoes(): ?array {
            return $this->repository->buscarTodasPermissoes();
        }

        public function atualizarPermissao(Permissao $permissao): void {
            $this->repository->alterarPermissao($permissao);
        }

        public function deletarPermissao(Permissao $permissao): void {
            $this->repository->deletarPermissao($permissao);
        }

    }

?>