<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

          <!-- início do card de busca -->
          <card-component titulo="Busca de alunos">
            <template v-slot:conteudo>
                <div class="mb-3">
                  <input-container-component titulo= "ID" id= "inputId" id-help="idHelp" >
                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID" v-model="busca.id"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                 <input-container-component titulo= "Nome Oficial" id= "inputNomeOf" id-help="nomeOfHelp" >
                    <input type="text" class="form-control" id="inputNomeOf" aria-describedby="nomeOfHelp" placeholder="Nome Oficial" v-model="busca.nome_oficial"/>
                  </input-container-component>
                </div>
                  <div class="mb-3">
                   <input-container-component titulo= "Nome Social" id= "inputNomeSos" id-help="nomeSosHelp" >
                    <input type="text" class="form-control" id="inputNomeSos" aria-describedby="nomeSosHelp" placeholder="Nome Social" v-model="busca.nome_social"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Data de Nascimento" id= "inputDataNasc" id-help="DataNascHelp" >
                    <input type="text" class="form-control" id="inputDataNasc" aria-describedby="DataNascHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="busca.data_nascimento"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                    <input-container-component titulo= "Gênero" id= "inputGenero" id-help="GeneroHelp" >
                    <select class="form-control" id="inputGenero" aria-describedby="GeneroHelp" v-model="busca.genero">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Homem</option>
                        <option value="2">Mulher</option>
                        <option value="3">Ambos</option>
                        <option value="4">Nenhum</option>
                        <option value="5">Preferiu não informar</option>
                    </select>
                  </input-container-component>
                </div>
                <div class="mb-3">
                   <input-container-component titulo= "Cpf" id= "inputCpf" id-help="CpfHelp" >
                    <input type="text" class="form-control" id="inputCpf" aria-describedby="CpfHelp" placeholder="Cpf. 000.000.000-00" v-mask="'###.###.###-##'" v-model="busca.cpf"/>
                  </input-container-component>
                </div>
                 <div class="mb-3">
                   <input-container-component titulo= "Cep" id= "inputCep" id-help="CepHelp" >
                    <input type="text" class="form-control" id="inputCep" aria-describedby="CepHelp" placeholder="Cep. 00000-000" v-mask="'#####-###'" v-model="busca.cep"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                    <input-container-component titulo= "Cor" id= "inputCor" id-help="CorHelp" >
                    <select class="form-control" id="inputCor" aria-describedby="CorHelp" v-model="busca.cor">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Afrodescendente</option>
                        <option value="2">Indígena</option>
                        <option value="3">Amarelo</option>
                        <option value="4">Negro</option>
                        <option value="5">Branco</option>
                        <option value="6">Preto</option>
                        <option value="7">Pardo</option>
                    </select>
                  </input-container-component>
                </div>
            </template>

          <template v-slot:rodape>
            <button type="submit" class="btn btn-primary btn-sm float-right" @click="pesquisar()">Pesquisar</button>
          </template>
        </card-component>
        <!-- fim do card de busca -->

        <!-- início do card de listagem de alunos -->
        <card-component titulo="Relação de alunos">
            <template v-slot:conteudo>
              <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nome Of.</th>
                              <th scope="col">Nome Soc.</th>
                              <th scope="col">Data.</th>
                              <th scope="col">Gênero</th>
                              <th scope="col">Cpf</th>
                              <th scope="col">Cep</th>
                              <th scope="col">Cor</th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                                                            
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="obj in alunos" :key="obj.id">
                              <th scope="row">{{obj.id}}</th>
                              <td>{{obj.nome_oficial}}</td>
                              <td>{{obj.nome_social}}</td>
                              <td>{{obj.data_nascimento}}</td>
                              <td>{{obj.genero}}</td>
                              <td>{{obj.cpf}}</td>
                              <td>{{obj.cep}}</td>
                              <td>{{obj.cor}}</td>
                              <td><button type="button" class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#modalAlunoVisualizar" @click="setStore(obj)">Ver</button></td>
                              <td><button type="button" class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#modalAlunoEditar" @click="setStore(obj)">Editar</button></td>
                              <td><button type="button" class="btn btn-outline-danger btn-sm float-right" data-toggle="modal" data-target="#modalAlunoRemover" @click="setStore(obj)">Remover</button></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalAluno">Adicionar</button>
            </template>
        </card-component>
        <!-- fim do card de listagem de alunos -->

      </div>
    </div>
    <!-- modal de adicionar aluno -->
    <modal-component id="modalAluno" titulo="Adicionar aluno">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="transacaoDetalhes" titulo = "Cadastro realizado com sucesso" v-if= "transacaoStatus == 'adicionado'"></alert-component>
        <alert-component tipo ="danger " :detalhes="transacaoDetalhes" titulo = "Erro ao tentar cadastrar " v-if= "transacaoStatus == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo>
          <div class="form-group">
              <input-container-component titulo="Nome Oficial" id="novoNomeOf" id-help="novoNomeOfHelp" >
                  <input type="text" class="form-control" id="novoNomeOf" aria-describedby="novoNomeOfHelp" placeholder="Nome oficial" v-model="nomeOficialAluno">
              </input-container-component>
              
          </div>
          <div class="form-group">
              <input-container-component titulo="Nome Social" id="novoNomeSoc" id-help="novoNomeSocHelp" >
                  <input type="text" class="form-control" id="novoNomeSoc" aria-describedby="novoNomeSocHelp" placeholder="Nome social" v-model="nomeSocialAluno">
              </input-container-component>
              
          </div>
          <div class="mb-3">
                  <input-container-component titulo= "Data de Nascimento" id= "novoDataNasc" id-help="novoDataNascHelp" >
                    <input type="text" class="form-control" id="novoDataNasc" aria-describedby="novoDataNascHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="dataNascimentoAluno"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                    <input-container-component titulo= "Gênero" id= "novoGenero" id-help="novoGeneroHelp" >
                    <select class="form-control" id="novoGenero" aria-describedby="novoGeneroHelp" v-model="generoAluno">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Homem</option>
                        <option value="2">Mulher</option>
                        <option value="3">Ambos</option>
                        <option value="4">Nenhum</option>
                        <option value="5">Preferiu não informar</option>
                    </select>
                  </input-container-component>
                </div>
                <div class="mb-3">
                   <input-container-component titulo= "Cpf" id= "novoCpf" id-help="novoCpfHelp" >
                    <input type="text" class="form-control" id="novoCpf" aria-describedby="novoCpfHelp" placeholder="Cpf. 000.000.000-00" v-mask="'###.###.###-##'" v-model="cpfAluno"/>
                  </input-container-component>
                </div>
                 <div class="mb-3">
                   <input-container-component titulo= "Cep" id= "novoCep" id-help="novoCepHelp" >
                    <input type="text" class="form-control" id="novoCep" aria-describedby="novoCepHelp" placeholder="Cep. 00000-000" v-mask="'#####-###'" v-model="cepAluno"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                    <input-container-component titulo= "Cor" id= "novoCor" id-help="novoCorHelp" >
                    <select class="form-control" id="novoCor" aria-describedby="novoCorHelp" v-model="corAluno">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Afrodescendente</option>
                        <option value="2">Indígena</option>
                        <option value="3">Amarelo</option>
                        <option value="4">Negro</option>
                        <option value="5">Branco</option>
                        <option value="6">Preto</option>
                        <option value="7">Pardo</option>
                    </select>
                  </input-container-component>
                </div>
                <div class="mb-3">
                   <input-container-component titulo= "Descrição" id= "novoDescricao" id-help="novoDescricaoHelp" >
                    <input type="text" class="form-control" id="novoDescricao" aria-describedby="novoDescricaoHelp" placeholder="Descrição" v-model="descricaoAluno"/>
                  </input-container-component>
                </div>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
      </template>
    </modal-component>
    <!-- fim do modal de adicionar aluno -->

    <!-- modal de vizualizar aluno -->

    <modal-component id="modalAlunoVisualizar" titulo="Vizualizar aluno">
      <template v-slot:alertas></template>
      <template v-slot:conteudo>
        <input-container-component titulo="ID da aluno">
          <input type="text" class="form-control" :value="$store.state.item.id" disabled>
        </input-container-component>
        <input-container-component titulo="Nome oficial">
          <input type="text" class="form-control" :value="$store.state.item.nome_oficial" disabled>
        </input-container-component>
        <input-container-component titulo="Nome Social">
          <input type="text" class="form-control" :value="$store.state.item.nome_social" disabled>
        </input-container-component>
        <input-container-component titulo="Data Nascimento">
          <input type="text" class="form-control" :value="$store.state.item.data_nascimento" disabled>
        </input-container-component>
        <input-container-component titulo="Gênero">
          <input type="text" class="form-control" v-mask="'##/##/####'" :value="$store.state.item.genero" disabled>
        </input-container-component>
        <input-container-component titulo="Cpf">
          <input type="text" class="form-control" v-mask="'###.###.###-##'" :value="$store.state.item.cpf" disabled>
        </input-container-component>
        <input-container-component titulo="Cep">
          <input type="text" class="form-control" v-mask="'#####-###'" :value="$store.state.item.cep" disabled>
        </input-container-component>
        <input-container-component titulo="Cor">
          <input type="text" class="form-control" :value="$store.state.item.cor" disabled>
        </input-container-component>
        <input-container-component titulo="Descrição">
          <input type="text" class="form-control" :value="$store.state.item.descricao" disabled>
        </input-container-component>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </template>
    </modal-component>

    <!-- fim do modal de vizualizar aluno -->

     <!-- modal de remover aluno -->

    <modal-component id="modalAlunoRemover" titulo="Remover aluno">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="$store.state.transacao" titulo = "Transação realizada com sucesso" v-if="$store.state.transacao.status == 'sucesso'" ></alert-component>
        <alert-component tipo ="danger" :detalhes="$store.state.transacao" titulo = "Erro na transação" v-if="$store.state.transacao.status == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">
        <input-container-component titulo="ID ">
          <input type="text" class="form-control" :value="$store.state.item.id" disabled>
        </input-container-component>
        <input-container-component titulo="Nome">
          <input type="text" class="form-control" :value="$store.state.item.nome_oficial" disabled>
        </input-container-component>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-danger"  v-if="$store.state.transacao.status != 'sucesso'" @click="remover()">Remover</button>
      </template>
    </modal-component>

    <!-- fim do modal de remover aluno -->

    <!-- modal de editar aluno -->
    <modal-component id="modalAlunoEditar" titulo="Editar aluno">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="$store.state.transacao" titulo = "Transação realizada com sucesso" v-if="$store.state.transacao.status == 'sucesso'" ></alert-component>
        <alert-component tipo ="danger" :detalhes="$store.state.transacao" titulo = "Erro na transação" v-if="$store.state.transacao.status == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo>
          <div class="form-group">
              <input-container-component titulo="Nome Oficial" id="atualizarNomeOf" id-help="atualizarNomeOfHelp" >
                  <input type="text" class="form-control" id="atualizarNomeOf" aria-describedby="atualizarNomeOfHelp" placeholder="Nome oficial" v-model="$store.state.item.nome_oficial">
              </input-container-component>
          </div>
          <div class="form-group">
              <input-container-component titulo="Nome Social" id="atualizarNomeSoc" id-help="atualizarNomeSocHelp" >
                  <input type="text" class="form-control" id="atualizarNomeSoc" aria-describedby="atualizarNomeSocHelp" placeholder="Nome social" v-model="$store.state.item.nome_social">
              </input-container-component>
          </div>
          <div class="mb-3">
                  <input-container-component titulo= "Data de Nascimento" id= "atualizarDataNasc" id-help="atualizarDataNascHelp" >
                    <input type="text" class="form-control" id="atualizarDataNasc" aria-describedby="atualizarDataNascHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="$store.state.item.data_nascimento"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                    <input-container-component titulo= "Gênero" id= "atualizarGenero" id-help="atualizarGeneroHelp" >
                    <select class="form-control" id="atualizarGenero" aria-describedby="atualizarGeneroHelp" v-model="$store.state.item.genero">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Homem</option>
                        <option value="2">Mulher</option>
                        <option value="3">Ambos</option>
                        <option value="4">Nenhum</option>
                        <option value="5">Preferiu não informar</option>
                    </select>
                  </input-container-component>
                </div>
                <div class="mb-3">
                   <input-container-component titulo= "Cpf" id= "atualizarCpf" id-help="atualizarCpfHelp" >
                    <input type="text" class="form-control" id="atualizarCpf" aria-describedby="atualizarCpfHelp" placeholder="Cpf. 000.000.000-00" v-mask="'###.###.###-##'" v-model="$store.state.item.cpf"/>
                  </input-container-component>
                </div>
                 <div class="mb-3">
                   <input-container-component titulo= "Cep" id= "atualizarCep" id-help="atualizarCepHelp" >
                    <input type="text" class="form-control" id="atualizarCep" aria-describedby="atualizarCepHelp" placeholder="Cep. 00000-000" v-mask="'#####-###'" v-model="$store.state.item.cep"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                    <input-container-component titulo= "Cor" id= "atualizarCor" id-help="atualizarCorHelp" >
                    <select class="form-control" id="atualizarCor" aria-describedby="atualizarCorHelp" v-model="$store.state.item.cor">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Afrodescendente</option>
                        <option value="2">Indígena</option>
                        <option value="3">Amarelo</option>
                        <option value="4">Negro</option>
                        <option value="5">Branco</option>
                        <option value="6">Preto</option>
                        <option value="7">Pardo</option>
                    </select>
                  </input-container-component>
                </div>
                <div class="mb-3">
                   <input-container-component titulo= "Descrição" id= "atualizarDescricao" id-help="atualizarDescricaoHelp" >
                    <input type="text" class="form-control" id="atualizarDescricao" aria-describedby="atualizarDescricaoHelp" placeholder="Descrição" v-model="$store.state.item.descricao"/>
                  </input-container-component>
                </div>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="atualizar()">Atualizar</button>
      </template>
    </modal-component>
    <!-- fim do modal de editar aluno -->


  </div>
</template>
<script>
import InputContainer from './InputContainer.vue'
  export default {
  components: { InputContainer },
    data() {
        return {
            urlBase: 'http://localhost:8000/api/aluno',
            urlFiltro: '',
            nomeOficialAluno: '',
            nomeSocialAluno: '',
            dataNascimentoAluno: '',
            generoAluno: '',
            cpfAluno: '',
            cepAluno: '',
            corAluno: '',
            descricaoAluno: '',
            transacaoStatus: '',
            transacaoDetalhes: {},
            alunos: [],
            busca:{id: '', nome_oficial: '', nome_social: '', data_nascimento: '', genero: '', cpf: '', cep: '', cor: ''}
            
        }
    },
    
    methods: {
      atualizar(){   

        let formData = new FormData();
        formData.append('_method','patch')
        formData.append('nome_oficial',this.$store.state.item.nome_oficial)
        formData.append('nome_social',this.$store.state.item.nome_social)
        formData.append('data_nascimento',this.$store.state.item.data_nascimento)
        formData.append('genero',this.$store.state.item.genero)
        formData.append('cpf',this.$store.state.item.cpf)
        formData.append('cep',this.$store.state.item.cep)
        formData.append('cor',this.$store.state.item.cor)
        formData.append('descricao',this.$store.state.item.descricao)

        let config = {
          headers: {
            'Content-Type': 'multipart/form-data',
            'Accept': 'application/json',
            'Authorization': this.token
          }
        }
        
        let url = this.urlBase + '/' + this.$store.state.item.id

        axios.post(url,formData,config)
          .then(response =>{
            this.$store.state.transacao.status = 'sucesso'
            this.$store.state.transacao.mensagem = 'Registro atualizado com sucesso'
            this.carregarLista()
          })
          .catch(errors=>{
            this.$store.state.transacao.status = 'erro'
            this.$store.state.transacao.mensagem = errors.response.data.message  
            this.$store.state.transacao.dados = errors.response.data.errors                   
          })

     },

      remover(){

        let confirmacao = confirm('Tem certeza que deseja remover esse registro?')
        if(!confirmacao){
          return false;
        } 

        let formData = new FormData();
        formData.append('_method','delete')

        let config = {
          headers: {
            'Accept': 'application/json',
            'Authorization': this.token
          }
        }
        
        let url = this.urlBase + '/' + this.$store.state.item.id

        axios.post(url,formData,config)
          .then(response =>{
            this.$store.state.transacao.status = 'sucesso'
            this.$store.state.transacao.mensagem = response.data.msg
            this.carregarLista()
          })
          .catch(errors=>{
            this.$store.state.transacao.status = 'erro'
            this.$store.state.transacao.mensagem = errors.response.data.erro
            this.carregarLista()         
          })
      },


      setStore(obj){
        this.$store.state.item = obj
        this.$store.state.transacao.status= ''
        this.$store.state.transacao.mensagem= ''
        this.$store.state.transacao.dados= ''
      },

      pesquisar(){
        //console.log(this.busca)
        let filtro = ''

        for(let chave in this.busca){
          if(this.busca[chave]){
            if(filtro!= ''){
              filtro += ";"
            }
            filtro += chave + ':like:' + this.busca[chave] + '%'
          } 
        }
        if(filtro!=''){
          this.urlFiltro = 'filtro=' + filtro
        }else{
          this.urlFiltro = ''
        }
        this.carregarLista()

      },
      carregarLista(){

          let url = this.urlBase + '?' + this.urlFiltro
          
          axios.get(url)
          .then(response =>{
            this.alunos = response.data
            //console.log(this.alunos)
          })
          .catch(errors=>{
            console.log(errors)
          })
      },

      salvar() {
          console.log(this.idProfAluno, this.nomeDisciplina)

          let formData = new FormData();
          formData.append('professor_id', this.idProfDisciplina)
          formData.append('nome', this.nomeDisciplina)
          formData.append('nome_oficial',this.nomeOficialAluno)
          formData.append('nome_social',this.nomeSocialAluno)
          formData.append('data_nascimento',this.dataNascimentoAluno)
          formData.append('genero',this.generoAluno)
          formData.append('cpf',this.cpfAluno)
          formData.append('cep',this.cepAluno)
          formData.append('cor',this.corAluno)
          formData.append('descricao',this.descricaoAluno)

          let config = {
              headers: {
                  'Content-Type': 'multipart/form-data',
                  'Accept': 'application/json'
              }
          }

          axios.post(this.urlBase, formData, config)
              .then(response => {
                  this.transacaoStatus = 'adicionado'
                  this.transacaoDetalhes = {
                    mensagem: 'ID do registro: ' + response.data.id
                  }
                  //console.log(response)
              })
              .catch(errors => {
                  this.transacaoStatus = 'erro'
                  this.transacaoDetalhes = {
                    mensagem: errors.response.data.message,
                    dados: errors.response.data.errors
                  }
                  //console.log(errors.response.data.message)
              })
      }
    },
    mounted(){
     this.carregarLista()
    }
}
</script>
