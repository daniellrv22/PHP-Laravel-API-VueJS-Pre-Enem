<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

          <!-- início do card de busca -->
          <card-component titulo="Busca de disciplinas">
            <template v-slot:conteudo>
                <div class="mb-3">
                  <input-container-component titulo= "ID" id= "inputId" id-help="idHelp" texto-ajuda="Opcional.">
                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID" v-model="busca.id"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "ID do Professor" id= "inputIdProf" id-help="IdProfHelp" texto-ajuda="Opcional.">
                    <input type="number" class="form-control" id="inputIdProf" aria-describedby="IdProfHelp" placeholder="Ex.1,2,3" v-model="busca.professor_id"/>
                  </input-container-component>
                </div>
                 <div class="form">
                <div class="mb-3">
                  <input-container-component titulo= "Nome da disciplina" id= "inputNome" id-help="nomeHelp" texto-ajuda="Opcional.">
                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome" v-model="busca.nome"/>
                  </input-container-component>
                </div>
              </div>
            </template>

          <template v-slot:rodape>
            <button type="submit" class="btn btn-primary btn-sm float-right" @click="pesquisar()">Pesquisar</button>
          </template>
        </card-component>
        <!-- fim do card de busca -->

        <!-- início do card de listagem de disciplinas -->
        <card-component titulo="Relação de disciplinas">
            <template v-slot:conteudo>
              <div>
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nome da Disciplina</th>
                              <th scope="col">Professor Relacionado</th>
                              <th scope="col">Visualizar</th>
                              <th scope="col">Editar</th>
                              <th scope="col">Remover</th>
                                                            
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="obj in disciplinas" :key="obj.id">
                              <th scope="row">{{obj.id}}</th>
                              <td>{{obj.nome}}</td>
                              <td>{{obj.professor.nome_oficial}}</td>
                              <td><button type="button" class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#modalDisciplinaVisualizar" @click="setStore(obj)">Visualizar</button></td>
                              <td><button type="button" class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#modalDisciplinaEditar" @click="setStore(obj)">Editar</button></td>
                              <td><button type="button" class="btn btn-outline-danger btn-sm float-right" data-toggle="modal" data-target="#modalDisciplinaRemover" @click="setStore(obj)">Remover</button></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalDisciplina">Adicionar</button>
            </template>
        </card-component>
        <!-- fim do card de listagem de disciplinas -->

      </div>
    </div>
    <!-- modal de adicionar disciplina -->
    <modal-component id="modalDisciplina" titulo="Adicionar disciplina">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="transacaoDetalhes" titulo = "Cadastro realizado com sucesso" v-if= "transacaoStatus == 'adicionado'"></alert-component>
        <alert-component tipo ="danger " :detalhes="transacaoDetalhes" titulo = "Erro ao tentar cadastrar a Disciplina" v-if= "transacaoStatus == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo>
         <div class="form-group">
              <input-container-component titulo="ID professor" id="novoIdProf" id-help="novoIdProfHelp" texto-ajuda="Informe um ID de Professor">
                  <input type="number" class="form-control-file" id="novoIdProf" aria-describedby="novoIdProfHelp" placeholder="Ex. 1" v-model="idProfDisciplina">
              </input-container-component>
              
          </div>
          <div class="form-group">
              <input-container-component titulo="Nome da disciplina" id="novoNome" id-help="novoNomeHelp" texto-ajuda="Informe o nome da disciplina">
                  <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome da disciplina" v-model="nomeDisciplina">
              </input-container-component>
             
          </div>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
      </template>
    </modal-component>
    <!-- fim do modal de adicionar disciplina -->

    <!-- modal de vizualizar disciplina -->

    <modal-component id="modalDisciplinaVisualizar" titulo="Vizualizar disciplina">
      <template v-slot:alertas></template>
      <template v-slot:conteudo>
        <input-container-component titulo="ID da disciplina">
          <input type="text" class="form-control" :value="$store.state.item.id" disabled>
        </input-container-component>
        <input-container-component titulo="ID e Nome do Professor ">
          <input type="text" class="form-control" :value="$store.state.item.professor.id" disabled>
          <input type="text" class="form-control" :value="$store.state.item.professor.nome_oficial" disabled>
        </input-container-component>
        <input-container-component titulo="Nome da Disciplina">
          <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
        </input-container-component>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </template>
    </modal-component>

    <!-- fim do modal de vizualizar disciplina -->

     <!-- modal de remover disciplina -->

    <modal-component id="modalDisciplinaRemover" titulo="Remover disciplina">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="$store.state.transacao" titulo = "Transação realizada com sucesso" v-if="$store.state.transacao.status == 'sucesso'" ></alert-component>
        <alert-component tipo ="danger" :detalhes="$store.state.transacao" titulo = "Erro na transação" v-if="$store.state.transacao.status == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">
        <input-container-component titulo="ID da disciplina">
          <input type="text" class="form-control" :value="$store.state.item.id" disabled>
        </input-container-component>
        <input-container-component titulo="Nome da Disciplina">
          <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
        </input-container-component>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-danger"  v-if="$store.state.transacao.status != 'sucesso'" @click="remover()">Remover</button>
      </template>
    </modal-component>

    <!-- fim do modal de remover disciplina -->

    <!-- modal de editar disciplina -->
    <modal-component id="modalDisciplinaEditar" titulo="Editar disciplina">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="$store.state.transacao" titulo = "Transação realizada com sucesso" v-if="$store.state.transacao.status == 'sucesso'" ></alert-component>
        <alert-component tipo ="danger" :detalhes="$store.state.transacao" titulo = "Erro na transação" v-if="$store.state.transacao.status == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo>
         <div class="form-group">
              <input-container-component titulo="ID professor" id="atualizarIdProf" id-help="atualizarIdProfHelp" texto-ajuda="Informe um ID de Professor">
                  <input type="number" class="form-control-file" id="atualizarIdProf" aria-describedby="atualizarIdProfHelp" placeholder="Ex. 1" v-model="$store.state.item.professor_id">
              </input-container-component>
          </div>
          <div class="form-group">
              <input-container-component titulo="Nome da disciplina" id="atualizarNome" id-help="atualizarNomeHelp" texto-ajuda="Informe o nome da disciplina">
                  <input type="text" class="form-control" id="atualizarNome" aria-describedby="atualizarNomeHelp" placeholder="Nome da disciplina" v-model="$store.state.item.nome">
              </input-container-component>             
          </div>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="atualizar()">Atualizar</button>
      </template>
    </modal-component>
    <!-- fim do modal de editar disciplina -->


  </div>
</template>
<script>
import InputContainer from './InputContainer.vue'
  export default {
  components: { InputContainer },
    data() {
        return {
            urlBase: 'http://localhost:8000/api/disciplina',
            urlFiltro: '',
            idProfDisciplina: '',
            nomeDisciplina: '',
            transacaoStatus: '',
            transacaoDetalhes: {},
            disciplinas: [],
            busca:{id: '', professor_id: '', nome: '' }
            
        }
    },
    
    methods: {
      atualizar(){   

        let formData = new FormData();
        formData.append('_method','patch')
        formData.append('prfofessor_id',this.$store.state.item.professor_id)
        formData.append('nome',this.$store.state.item.nome)

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
            this.disciplinas = response.data
            //console.log(this.disciplinas)
          })
          .catch(errors=>{
            console.log(errors)
          })
      },

      salvar() {
          console.log(this.idProfDisciplina, this.nomeDisciplina)

          let formData = new FormData();
          formData.append('professor_id', this.idProfDisciplina)
          formData.append('nome', this.nomeDisciplina)

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
