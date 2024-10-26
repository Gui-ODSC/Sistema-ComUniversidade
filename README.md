# Sistema ComUniversidade
 - #### O ComUniversidade tem o objetivo principal de conectar a sociedade e a universidade, promovendo maior interação entre ambas as partes. Desse modo, o sistema busca garantir que o conhecimento produzido por servidores e alunos através de ações de extensão universitária, chegue de maneira efetiva até a comunidade. Da mesma forma, possibilitando que as necessidades enfrentadas pela sociedade também sejam comunicadas para as universidades, facilitando assim a interação e, consequentemente, a criação de ações de extensão cada vez mais alinhadas com a realidade.
 - #### Este sistema busca apoiar as Instituições de Ensino Superior (IES), auxiliando-as no estabelecimento de relações mais próximas entre a comunidade universitária e os diversos setores da sociedade. Por meio da criação do sistema proposto, será possível que as ações de extensão das IES não apenas enriqueçam os currículos dos cursos, mas também atendam às necessidades expressas pela sociedade.


# Apresenta
### 3 Tipos de Perfis:
 - #### Membros Externos
 - #### Servidores
 - #### Estudantes
   
### Utiliza sistema de Matchings para conectar seus usuários
 - #### O algoritmo selecionado para realizar a análise de similaridade, considerando que as strings analisadas são geralmente curtas (até 500 caracteres), é o Ratcliff-Obershelp Similarity. Esse algoritmo foi utilizado e adaptado para promover a conexão entre necessidades e ofertas cadastradas e consequentemente facilitar a comunicação entre Membros Externos, Servidores e Estudantes, proporcionando maior interação e contribuindo para a dialogicidade entre Universidade e Comunidade.

# Informações sobre o sistema
### Tecnologias Utilizadas
- #### PHP v.8.2.18
- #### Laravel v.10.37.2
- #### MySQL v.8.0.36
- #### Adminer v.4.8.1

# Passo a passo para clonar o repo
- #### Ter o php e mysql instalados (versões disponíveis acima)
- #### Abrir um terminal de comando (cmd)
- #### $~ git clone git@github.com:Gui-ODSC/Sistema-ComUniversidade.git
- #### $~ cd Sistema-ComUniversidade/
- #### $~ composer install - (baixar composer caso não tenha)
- #### $~ cp .env.example .env
- #### $~ php artisan key:generate
- #### Criar um database no banco de dados 
- #### Configurar as variáveis de ambiente do .env com as configs de acesso do Database que criou
- #### $~ php artisan migrate
- Adicionar dump de ceps no banco de dados [Dump_Ceps](https://acesse.one/ccq7K) 
- #### $~ php artisan serve
- Acessar a URL [Sistema](http://localhost:8000/)
- FIM

###### Obs: tudo que tiver com o símbolo ($~) são comandos que devem ser realizados no terminal 

### Desenvolvido por
- #### *Guilherme Oliveira de Sá Cabrera*
### Orientado por
- #### *Andréa Sabedra Bordin*
