<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 20:14
 */

class avaliacao
{
    private $idAvaliacao;
    private $nota1;
    private $nota2;
    private $notaFinal;
    private $curso;
    private $aluno;
    private $turma;

    public function __construct($idAvaliacao, $nota1, $nota2, $notaFinal, $curso, $aluno, $turma)
    {
        $this->idAvaliacao = $idAvaliacao;
        $this->nota1 = $nota1;
        $this->nota2 = $nota2;
        $this->notaFinal = $notaFinal;
        $this->curso = $curso;
        $this->aluno = $aluno;
        $this->turma = $turma;
    }

    public function getIdAvaliacao()
    {
        return $this->idAvaliacao;
    }
    public function getNota1()
    {
        return $this->nota1;
    }
    public function getNota2()
    {
        return $this->nota2;
    }
    public function getNotaFinal()
    {
        return $this->notaFinal;
    }
    public function getCurso()
    {
        return $this->curso;
    }
    public function setIdAvaliacao($idAvaliacao)
    {
        $this->idAvaliacao = $idAvaliacao;
    }
    public function setNota1($nota1)
    {
        $this->nota1 = $nota1;
    }
    public function setNota2($nota2)
    {
        $this->nota2 = $nota2;
    }
    public function setNotaFinal($notaFinal)
    {
        $this->notaFinal = $notaFinal;
    }
    public function getAluno()
    {
        return $this->aluno;
    }
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }
    public function setAluno($aluno)
    {
        $this->aluno = $aluno;
    }
    public function getTurma()
    {
        return $this->turma;
    }
    public function setTurma($turma)
    {
        $this->turma = $turma;
    }

    public function validaAprovacao(){
        $sum_notas = $this->nota1 + $this->nota2;
        $media = $sum_notas/2;

        if($media>=7){
            return 'Aprovado';
        }elseif($media/2<4){
            return 'Reprovado';
        }elseif($this->notaFinal != null){
            $media = ($media+$this->notaFinal)/2;
            if($media >=6){
                return 'Aprovado';
            }else{
                return 'Reprovado';
            }
        }
    }

}