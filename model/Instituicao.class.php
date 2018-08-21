<?php

include_once dirname(__FILE__) . "/../config/config.php";
include_once "Banco1.class.php";

class Instituicao extends Banco1 {

    private $id;
    private $nome;
    private $endereco;
    private $estado;
    private $cidade;
    private $modulo;
    private $valor;

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getModulo() {
        return $this->modulo;
    }

    function getValor() {
        return $this->valor;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setModulo($modulo) {
        $this->modulo = $modulo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    public function salvar() {
        try {

            $query = "INSERT INTO instituicao (nome_institu,endereco_institu,estado,cidade,modulos,valor) VALUES (:nome_institu,:endereco_institu,:estado,:cidade,:modulos,:valor) ";

            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':nome_institu', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindParam(':endereco_institu', $this->endereco, PDO::PARAM_STR);
            $this->stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
            $this->stmt->bindParam(':cidade', $this->cidade, PDO::PARAM_STR);
            $this->stmt->bindParam(':modulos', $this->modulo, PDO::PARAM_STR);
            $this->stmt->bindParam(':valor', $this->valor, PDO::PARAM_STR);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function atualizar() {
        try {
            $query = "UPDATE instituicao SET nome_institu = :nome_institu, estado = :estado, cidade = :cidade, modulos = :modulos, valor = :valor WHERE id_institu = :id_institu ";
            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':nome_institu', $this->nome, PDO::PARAM_INT);
            $this->stmt->bindParam(':endereco_institu', $this->endereco, PDO::PARAM_INT);
            $this->stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
            $this->stmt->bindParam(':cidade', $this->cidade, PDO::PARAM_STR);
            $this->stmt->bindParam(':modulos', $this->modulo, PDO::PARAM_STR);
            $this->stmt->bindParam(':valor', $this->valor, PDO::PARAM_STR);
            $this->stmt->bindParam(':id_institu', $this->id, PDO::PARAM_INT);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function excluir() {
        try {
            $query = "DELETE FROM instituicao WHERE id_institu = :id_institu ";
            $this->stmt = $this->conn->prepare($query);
            $this->stmt->bindParam(':id_institu', $this->id, PDO::PARAM_INT);
            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

}

class usuario extends Banco1 {

    private $id;
    private $nome;
    private $nivel;
    private $login;
    private $senha;
    private $sexo;
    private $data_nasc;
    private $instituicao;
    private $email;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getData_nasc() {
        return $this->data_nasc;
    }

    function getInstituicao() {
        return $this->instituicao;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setData_nasc($data_nasc) {
        $this->data_nasc = $data_nasc;
    }

    function setInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    public function salvar() {
        try {

            $query = "INSERT INTO usuario (nome,nivel,login,senha,sexo,data_nasc,instituicao,email) VALUES (:nome,:nivel,:login,:senha,:sexo,:data_nasc,:instituicao,:email) ";

            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':nome', $this->nome, PDO::PARAM_INT);
            $this->stmt->bindParam(':nivel', $this->nivel, PDO::PARAM_INT);
            $this->stmt->bindParam(':login', $this->login, PDO::PARAM_STR);
            $this->stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $this->stmt->bindParam(':sexo', $this->sexo, PDO::PARAM_STR);
            $this->stmt->bindParam(':data_nasc', $this->data_nasc, PDO::PARAM_STR);
            $this->stmt->bindParam(':instituicao', $this->instituicao, PDO::PARAM_STR);
            $this->stmt->bindParam(':email', $this->email, PDO::PARAM_STR);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function atualizar() {
        try {
            $query = "UPDATE usuario SET nome = :nome, nivel = :nivel, login = :login, senha = :senha, sexo = :sexo, data_nasc = :data_nasc, instituicao = :instituicao, email = :email WHERE id_usuario = :id_usuario ";
            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':id_usuario', $this->id, PDO::PARAM_INT);
            $this->stmt->bindParam(':nome', $this->nome, PDO::PARAM_INT);
            $this->stmt->bindParam(':nivel', $this->nivel, PDO::PARAM_INT);
            $this->stmt->bindParam(':login', $this->login, PDO::PARAM_STR);
            $this->stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $this->stmt->bindParam(':sexo', $this->sexo, PDO::PARAM_STR);
            $this->stmt->bindParam(':data_nasc', $this->data_nasc, PDO::PARAM_STR);
            $this->stmt->bindParam(':instituicao', $this->instituicao, PDO::PARAM_STR);
            $this->stmt->bindParam(':email', $this->email, PDO::PARAM_STR);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function excluir() {
        try {
            $query = "DELETE FROM usuario WHERE id_usuario = :id_usuario ";
            $this->stmt = $this->conn->prepare($query);
            $this->stmt->bindParam(':id_usuario', $this->id, PDO::PARAM_INT);
            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

}

class modulo extends Banco1 {

    private $id;
    private $curso;
    private $tamanho;
    private $documentos;

    function getId() {
        return $this->id;
    }

    function getCurso() {
        return $this->curso;
    }

    function getTamanho() {
        return $this->tamanho;
    }

    function getDocumentos() {
        return $this->documentos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }

    function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }

    function setDocumentos($documentos) {
        $this->documentos = $documentos;
    }

    public function salvar() {
        try {

            $query = "INSERT INTO modulos (curso,tamanho,documentos) VALUES (:curso,:tamanho,:documentos) ";

            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':curso', $this->nome, PDO::PARAM_INT);
            $this->stmt->bindParam(':tamanho', $this->nivel, PDO::PARAM_INT);
            $this->stmt->bindParam(':documentos', $this->login, PDO::PARAM_STR);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function atualizar() {
        try {
            $query = "UPDATE modulos SET curso = :curso, tamanho = :tamanho, documentos = :documentos WHERE id_modulo = :id_modulo ";
            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':curso', $this->nome, PDO::PARAM_INT);
            $this->stmt->bindParam(':tamanho', $this->nivel, PDO::PARAM_INT);
            $this->stmt->bindParam(':documentos', $this->login, PDO::PARAM_STR);
            $this->stmt->bindParam(':id_modulo', $this->id, PDO::PARAM_INT);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function excluir() {
        try {
            $query = "DELETE FROM modulos WHERE id_modulo = :id_modulo ";
            $this->stmt = $this->conn->prepare($query);
            $this->stmt->bindParam(':id_modulo', $this->id, PDO::PARAM_INT);
            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

}

class funcionario_escola extends Banco1 {

    private $id;
    private $user;
    private $cpf;
    private $cargo;

    function getId() {
        return $this->id;
    }

    function getUser() {
        return $this->user;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getCargo() {
        return $this->cargo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    function setCargo($cargo) {
        $this->cargo = $cargo;
    }
        
    public function salvar() {
        try {

            $query = "INSERT INTO funcionario_escola (id_usuario,cpf,cargo) VALUES (:id_usuario,:cpf,:cargo) ";

            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':id_usuario', $this->user, PDO::PARAM_INT);
            $this->stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
            $this->stmt->bindParam(':cargo', $this->cargo, PDO::PARAM_STR);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function atualizar() {
        try {
            $query = "UPDATE funcionario_escola SET id_usuario = :id_usuario, cpf = :cpf, cargo = :cargo WHERE id_funcionario_escola = :id_funcionario_escola ";
            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':id_funcionario_escola', $this->id, PDO::PARAM_INT);
            $this->stmt->bindParam(':id_usuario', $this->user, PDO::PARAM_INT);
            $this->stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
            $this->stmt->bindParam(':cargo', $this->cargo, PDO::PARAM_STR);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function excluir() {
        try {
            $query = "DELETE FROM funcionario_escola WHERE id_funcionario_escola = :id_funcionario_escola ";
            $this->stmt = $this->conn->prepare($query);
            $this->stmt->bindParam(':id_funcionario_escola', $this->id, PDO::PARAM_INT);
            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

}
class professor extends Banco1 {

    private $id;
    private $user;

    function getId() {
        return $this->id;
    }

    function getUser() {
        return $this->user;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser($user) {
        $this->user = $user;
    }
        
    public function salvar() {
        try {

            $query = "INSERT INTO professor (id_usuario) VALUES (:id_usuario) ";

            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':id_usuario', $this->user, PDO::PARAM_INT);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function atualizar() {
        try {
            $query = "UPDATE professor SET id_usuario = :id_usuario WHERE id_professor = id_:professor ";
            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':id_professor', $this->id, PDO::PARAM_INT);
            $this->stmt->bindParam(':id_usuario', $this->user, PDO::PARAM_INT);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    public function excluir() {
        try {
            $query = "DELETE FROM professor WHERE id_professor = :id_professor ";
            $this->stmt = $this->conn->prepare($query);
            $this->stmt->bindParam(':id_professor', $this->id, PDO::PARAM_INT);
            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }
   // CREATE TABLE `aluno_engloba`.`professor` (
   //     `id_professor` INT NOT NULL AUTO_INCREMENT,
   //     `id_usuario` INT NOT NULL,
   //     PRIMARY KEY (`id_professor`),
   //     INDEX `id_usuario_idx` (`id_usuario` ASC),
   //     CONSTRAINT `id_usuario`
   //       FOREIGN KEY (`id_usuario`)
   //       REFERENCES `aluno_engloba`.`usuario` (`id_usuario`)
   //       ON DELETE CASCADE
   //       ON UPDATE CASCADE);
   class Aluno extends Banco1 {

    public $id_aluno;
    public $id_usuario;
    public $sobrenome;
    public $endereco;
    public $cidade;
    public $estado;
    public $cpf;
    public $telefone;
    public $matricula;
    public $curso;
    
    function getId_aluno() {
        return $this->id_aluno;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }
    
    function getSobrenome() {
        return $this->sobrenome;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getMatricula() {
        return $this->matricula;
    }

    function getCurso() {
        return $this->curso;
    }

    function setId_aluno($id_aluno) {
        $this->id_aluno = $id_aluno;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }

    public function salvar() {
        try {
            $query = "INSERT INTO aluno (sobrenome,endereco,cidade,estado,cpf,telefone,matricula,curso,id_usuario) VALUES (:sobrenome,:endereco,:cidade,:estado,:cpf,:telefone,:matricula,:curso,:id_usuario) ";

            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':sobrenome', $this->sobrenome, PDO::PARAM_STR);
            $this->stmt->bindParam(':endereco', $this->endereco, PDO::PARAM_STR);
            $this->stmt->bindParam(':cidade', $this->cidade, PDO::PARAM_STR);
            $this->stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
            $this->stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
            $this->stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
            $this->stmt->bindParam(':matricula', $this->matricula, PDO::PARAM_STR);
            $this->stmt->bindParam(':curso', $this->curso, PDO::PARAM_STR);
            $this->stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_STR);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    function atualizar() {
        try {
            $query = "UPDATE aluno SET sobrenome=:sobrenome,endereco=:endereco,cidade=:cidade,estado=:estado,cpf=:cpf,telefone=:telefone,matricula=:matricula,curso=:curso WHERE id_aluno = :id_aluno ";

            $this->stmt = $this->conn->prepare($query);

            $this->stmt->bindParam(':sobrenome', $this->sobrenome, PDO::PARAM_STR);
            $this->stmt->bindParam(':endereco', $this->endereco, PDO::PARAM_STR);
            $this->stmt->bindParam(':cidade', $this->cidade, PDO::PARAM_STR);
            $this->stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
            $this->stmt->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
            $this->stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
            $this->stmt->bindParam(':matricula', $this->matricula, PDO::PARAM_STR);
            $this->stmt->bindParam(':curso', $this->curso, PDO::PARAM_STR);
            $this->stmt->bindParam(':id_aluno', $this->id_aluno, PDO::PARAM_INT);

            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

    function excluir() {
        try {
            $query = "DELETE FROM aluno WHERE id_aluno = :id_aluno ";
            $this->stmt = $this->conn->prepare($query);
            $this->stmt->bindParam(':id_aluno', $this->id_aluno, PDO::PARAM_INT);
            if ($this->stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "<div class='erro'>" . $e->getMessage() . "</div>";
            return false;
        }
    }

}

}