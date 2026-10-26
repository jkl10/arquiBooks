<?php
    namespace Repository;

    use entity\Permissao;
    use PDO;

    class PermissaoRepository {
        private PDO $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        public function buscarPermissao(int $id): ?Permissao {
            $sql = 'SELECT id_permissao, nm_permissao FROM tb_permissao WHERE id_permissao = :id';

            $smt = $this->pdo->prepare($sql);

            $smt->execute([
                'id' => $id
            ]);

            $resposta = $smt->fetch();

            if($resposta === false) {
                return null;
            }

            $resposta = new Permissao(
                $resposta['nm_permissao'],
                (int) $resposta['id_permissao']
            );

            return $resposta;
        }

        public function buscarTodasPermissoes(): array {
            $sql = 'SELECT id_permissao, nm_permissao FROM tb_permissao';

            $smt = $this->pdo->prepare($sql);

            $smt->execute();

            $respostas = $smt->fetchAll();

            $permissoes = [];

            foreach($respostas as $resposta){
                $permissoes[] = new Permissao(
                    $resposta['nm_permissao'],
                    (int) $resposta['id_permissao']
                );
            }

            return $permissoes;
        }

        public function alterarPermissao(Permissao $permissao): void {
            $sql = 'UPDATE tb_permissao SET nm_permissao = :nome WHERE id_permissao = :id';

            $smt = $this->pdo->prepare($sql);

            $smt->execute([
                'nome' => $permissao->getNome(),
                'id' => $permissao->getId() 
            ]);
        }

        public function deletarPermissao(Permissao $permissao): void {
            $sql = 'DELETE FROM tb_permissao WHERE id_permissao = :id';

            $smt = $this->pdo->prepare($sql);

            $smt->execute([
                'id' => $permissao->getId()
            ]);
        }

        public function criarPermissao(Permissao $permissao): void {
            $sql = 'INSERT INTO tb_permissao (nm_permissao) VALUES (:nome)';

            $smt = $this->pdo->prepare($sql);

            $smt->execute([
                'nome' => $permissao->getNome()
            ]);

            $permissao->setId((int) $this->pdo->lastInsertId());
        }
    }

?>