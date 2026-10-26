<?php
    namespace Repository;

    use entity\Escola;
    use PDO;
    class EscolaRepository{
        private PDO $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        public function buscarEscola(int $id): ?Escola {
            
            $sql = 'SELECT id_escola, cd_escola, nm_escola FROM tb_escola WHERE id_escola = :id';

            $smt = $this->pdo->prepare($sql);

            $smt->execute(['id' => $id]);

            $resposta = $smt->fetch();

            if($resposta === false) {
                return null;
            }

            $escola = new Escola(
                (int)$resposta['cd_escola'],
                $resposta['nm_escola'],
                (int) $resposta['id_escola']
            );

            return $escola;
        }
        
        public function buscarTodasEscolas(): array {
            $sql = 'SELECT id_escola, nm_escola, cd_escola FROM tb_escola';

            $smt = $this->pdo->prepare($sql);
            $smt->execute();

            $respostas = $smt->fetchAll();

            $escolas = [];

            foreach($respostas as $resposta) {
                $escolas[] = new Escola(
                    (int) $resposta['cd_escola'],
                     $resposta['nm_escola'],
                    (int) $resposta['id_escola']
                );
            }
            return $escolas;
            
        }

        public function criarEscola(Escola $escola): void {
            $sql = 'INSERT INTO tb_escola (cd_escola,nm_escola) VALUES (:codigo,:nome)';

            $smt = $this->pdo->prepare($sql);

            $smt->execute([
                'codigo' => $escola->getCodigo(),
                'nome' => $escola->getNome()
            ]);

            $escola->setId((int) $this->pdo->lastInsertId());

        }

        public function alterarEscola(Escola $escola): void {
            $sql = 'UPDATE tb_escola SET cd_escola = :codigo, nm_escola = :nome WHERE id_escola = :id';

            $smt = $this->pdo->prepare($sql);

            $smt->execute([
                'codigo' => $escola->getCodigo(),
                'nome' => $escola->getNome(),
                'id' => $escola->getId()
            ]);
        }

        public function deletarEscola(Escola $escola): void {
            $sql = 'DELETE FROM tb_escola WHERE id_escola = :id';

            $smt = $this->pdo->prepare($sql);

            $smt->execute([
                'id' => $escola->getId()
            ]);
        }

    }
?>