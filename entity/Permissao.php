<?php
    namespace entity;

    class Permissao {
        private ?int $id = null;
        private string $nome;

        public function __construct(string $nome, ?int $id = null) {
            $this->id = $id;
            $this->nome = $nome;
        }

        public function getId(): ?int {
            return $this->id;
        }

        public function getNome(): ?string {
            return $this->nome;
        }

        public function setNome(string $nome): void {
            $this->nome = $nome;
        }
    }

?>