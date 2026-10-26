<?php
    namespace Entity;
    class Escola {
        private ?int $id = null;
        private int $codigo;
        private string $nome;

        public function __construct( int $codigo, string $nome, ?int $id = null) {
            $this->id = $id;
            $this->codigo = $codigo;
            $this->nome = $nome;

        }

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getCodigo():int {
            return $this->codigo;
        }

        public function getNome(): string {
            return $this->nome;
        }

        public function setId(int $id) {
            $this->id = $id;
        }

        public function setNome(string $nome): void {
            $this->nome = $nome;
        }

        public function setCodigo(int $codigo): void {
            $this->codigo = $codigo;
        }

    };
?>