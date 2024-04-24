<?php 

namespace App\View\Components\UsuarioProfessor\MatchingAcao;

use App\Models\Contato;
use App\Models\Oferta;
use App\Models\Usuario;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Closure;

class ModalInteressadosOferta extends Component
{
    public $contatos; 
    public $usuarios;

    public function __construct(public int $idOferta)
    {
        $usuarioId = Auth::id();
        $this->contatos = Contato::where('id_oferta', $idOferta)
                                 ->where('id_usuario_destino', $usuarioId)
                                 ->get();

        $this->usuarios = collect(); // Inicializa uma coleção vazia para armazenar os usuários

        foreach ($this->contatos as $contato) {
            $usuario = Usuario::findOrFail($contato->id_usuario_origem);
            $this->usuarios->push($usuario); // Adiciona o usuário à coleção de usuários
        }

        $this->usuarios = $this->usuarios->unique('id_usuario');
    }

    public function render(): View|Closure|string
    {
        $oferta = Oferta::findOrFail($this->idOferta); // Obtém a oferta dentro do método render

        return view('components.usuario-professor.matching_oferta.modal-interessados-oferta', [
            'usuarios' => $this->usuarios, // Passando todos os usuários para a view
            'oferta' => $oferta // Passando a oferta para a view
        ]);
    }
}