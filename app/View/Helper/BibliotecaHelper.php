<?php
App::uses('HtmlHelper', 'View/Helper');
class BibliotecaHelper extends HtmlHelper{ 
    public $helpers = array('Html');
    
    public function ValorMulta(){
        $valorMulta = 2.00;
        return $valorMulta;
    }
    
    public function RenovarPrazoLink($id_emprestimo_livro,$texto = null){
        return $this->Html->link($texto ? "Renovar" : $this->Html->image('extend.png'), 
                            array('controller' => 'Emprestimos','action' => 'renovar',$id_emprestimo_livro),
                            array('escape' => false, 'title' => "Renovar"), "Deseja renovar este empréstimo?");
    }
    
    public function CancelarReservaLink($id_reserva){
        return $this->Html->link($this->Html->image('trash.png'), 
                            array('controller' => 'Emprestimos','action' => 'cancelar_reserva',$id_reserva),
                            array('escape' => false, 'title' => "Cancelar Reserva"), "Deseja cancelar reserva?");
    }
    
    public function AlunoFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' ALUNOS ',array('controller' => 'Alunos', 'action' => 'index'));
    }
    public function AssuntoFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' ASSUNTOS ',array('controller' => 'Assuntos', 'action' => 'index'));
    }
    public function AutorFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' AUTORES ',array('controller' => 'Autors', 'action' => 'index'));
    }
    public function EditoraFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' EDITORAS ',array('controller' => 'Editoras', 'action' => 'index'));
    }
    public function EmprestimoFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' EMPRÉSTIMOS ',array('controller' => 'Emprestimos', 'action' => 'index'));
    }
    public function IdiomaFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' IDIOMAS ',array('controller' => 'Idiomas', 'action' => 'index'));
    }
    public function LivroFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' LIVROS ',array('controller' => 'Livros', 'action' => 'index'));
    }
    public function LocalizacaoFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' LOCALIZAÇÃO ',array('controller' => 'Localizacaos', 'action' => 'index'));
    }
    public function ProgramaFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' PROGRAMAS ',array('controller' => 'Programas', 'action' => 'index'));
    }
    public function TituloFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
            $this->Html->image('../img/arrow.png').
            $this->Html->link(' TÍTULOS ',array('controller' => 'Titulos', 'action' => 'index'));
    }
    public function RelatorioFastWLink(){
        return $this->Html->link(' BIBLIOTECA ','../')   .
        $this->Html->image('../img/arrow.png').
        $this->Html->link(' RELATÓRIOS ','../relatorios')   .
        $this->Html->image('../img/arrow.png');
    }

        public function DevolverLivroLink($id_livro_emprestimo,$texto = null){
            return $this->Html->link($texto? "Devolver" : $this->Html->image('recycle.png'), 
                        array('controller' => 'Emprestimos','action' => 'devolver',$id_livro_emprestimo),
                        array('escape' => false, 'title' => "Devolver"), "Registrar devolução?");
    }
    
    public function DetalhesMulta($id_multa){
            return $this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Multas','action' => 'view',$id_multa),
                        array('escape' => false, 'title' => "Detalhes Multa"));
    }
    
    public function RegistrarPagamentoMulta($id_multa){
            return $this->Html->link("Registrar Pagamento",//$this->Html->image('money.png'), 
                        array('controller' => 'Multas','action' => 'pagar',$id_multa),
                        array('escape' => false, 'title' => "Pagar"), "Registrar pagamento?");
    }
    
    public function DetalhesAluno($id_aluno){
        return $this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Alunos','action' => 'view',$id_aluno),
                        array('escape' => false, 'title' => "Detalhes"));
    }
    
    public function DetalhesEmprestimo($id_emprestimo){
        return $this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Emprestimos','action' => 'view',$id_emprestimo),
                        array('escape' => false, 'title' => "Detalhes"));
    }
    
    public function EditarAluno($id_aluno){
        return $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Alunos','action' => 'edit',$id_aluno),
                        array('escape' => false, 'title' => "Editar"));
    }
    
    public function EditarTitulo($id_titulo){
        return $this->Html->link($this->Html->image('edit.png'), 
                        array('controller' => 'Titulos','action' => 'edit',$id_titulo),
                        array('escape' => false, 'title' => "Editar"));
    }
    
    public function ReservarTituloAdm($ra_aluno, $id_titulo){
        return $this->Html->link("Reservar", 
                        array('controller' => 'Titulos','action' => 'reservar',$id_aluno,$id_titulo),
                        array('escape' => false, 'title' => "Editar"));
    }
    
    public function ReservarTitulo($id_aluno, $id_titulo){
        return $this->Html->link("Reservar", 
                        array('controller' => 'Titulos','action' => 'reservar',$id_aluno,$id_titulo),
                        array('escape' => false, 'title' => "Editar"));
    }
    public function ReservarTituloPAluno($id_titulo){
        return $this->Html->link("Reservar", 
                        array('controller' => 'Titulos','action' => 'reservarPAluno',$id_titulo),
                        array('escape' => false, 'title' => "Editar"));
    }
    
    public function ExcluirAluno($id_aluno){
        return $this->Html->link($this->Html->image('trash.png'), 
                        array('controller' => 'Alunos', 'action' => 'delete',$id_aluno),
                        array('escape' => false, 'title' => "Deletar"), "Deseja excluir este aluno?");
    }
    
    
    public function DetalhesLivro($id_livro){
        return $this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Livros','action' => 'view',$id_livro),
                        array('escape' => false, 'title' => "Detalhes"));
    }
    
    public function DetalhesTitulo($id_titulo){
        return $this->Html->link($this->Html->image('icondetails.png'), 
                        array('controller' => 'Titulos','action' => 'view',$id_titulo),
                        array('escape' => false, 'title' => "Detalhes"));
    }
    
    public function EditarLivroLink($id_livro){
        return $this->Html->link('Editar Livro',
                        array('controller' => 'Livros','action' => 'edit',$id_livro));
    }
    
    public function TodosLivros(){
        return $this->Html->link('Todos Livros',
                        array('controller' => 'Livros','action' => 'todos'));
    }
    
    public function TodosEmprestimosLivro($id_livro){
        return $this->Html->link('Empréstimos Livro',
                        array('controller' => 'Emprestimos','action' => 'resultado/livro/'.$id_livro));
    }
    
    public function BuscarLivro(){
        return $this->Html->link('Buscar Livro',
                        array('controller' => 'Livros','action' => 'index'));
    }
    
    public function NovoLivro(){
        return $this->Html->link('Novo Livro',
                        array('controller' => 'Livros','action' => 'add'));
    }
}



