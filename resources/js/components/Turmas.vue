<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

          <!-- início do card de busca -->
          <card-component titulo="Busca de turmas">
            <template v-slot:conteudo>
                <div class="mb-3">
                  <input-container-component titulo= "ID" id= "inputId" id-help="idHelp" >
                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID" v-model="busca.id"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "ID do aluno" id= "inputIdAluno" id-help="idAlunoHelp" >
                    <input type="number" class="form-control" id="inputIdAluno" aria-describedby="idAlunoHelp" placeholder="ID do aluno" v-model="busca.id_aluno"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "ID do professor" id= "inputIdProf" id-help="idProfHelp" >
                    <input type="number" class="form-control" id="inputIdProf" aria-describedby="idProfHelp" placeholder="ID do porfessor" v-model="busca.id_professor"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "ID da disciplina" id= "inputIdDisc" id-help="idDiscHelp" >
                    <input type="number" class="form-control" id="inputIdDisc" aria-describedby="idDiscHelp" placeholder="ID da disciplina"  v-model="busca.id_disciplina"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Data Inicial" id= "inputDataInicio" id-help="dataInicioHelp" >
                    <input type="text" class="form-control" id="inputDataInicio" aria-describedby="dataInicioHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="busca.data_inicio"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Data Final" id= "inputDataFim" id-help="dataFimHelp" >
                    <input type="text" class="form-control" id="inputDataFim" aria-describedby="dataFimHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="busca.data_final"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Horario Inicial" id= "inputHoraInicio" id-help="horaInicioHelp" >
                    <input type="text" class="form-control" id="inputHoraInicio" aria-describedby="horaInicioHelp" placeholder="Ex.00:00:00" v-mask="'##:##:##'" v-model="busca.hora_inicio"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Horario Final" id= "inputHoraFim" id-help="horaFimHelp" >
                    <input type="text" class="form-control" id="inputHoraFim" aria-describedby="horaFimHelp" placeholder="Ex.00:00:00" v-mask="'##:##:##'" v-model="busca.hora_final"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Numero de vagas total da Turma" id= "inputVagas" id-help="vagasHelp" >
                    <input type="number" class="form-control" id="inputVagas" aria-describedby="vagasHelp" placeholder="Ex.1,2,3" v-model="busca.vagas"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Horario ativo" id= "inputHorarioAtiv" id-help="horarioAtivHelp" >
                   <select class="form-control" id="inputHorarioAtiv" aria-describedby="horarioAtivHelp" v-model="busca.horario_ativo">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                  </input-container-component> 
                </div>                
            </template>

          <template v-slot:rodape>
            <button type="submit" class="btn btn-primary btn-sm float-right" @click="pesquisar()">Pesquisar</button>
          </template>
        </card-component>
        <!-- fim do card de busca -->

        <!-- início do card de listagem de turmas -->
        <card-component titulo="Relação de turmas">
            <template v-slot:conteudo>
              <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th scope="col">ID</th>
                              <th scope="col">ID Aluno</th>
                              <th scope="col">ID Prof.</th>
                              <th scope="col">ID Disc.</th>
                              <th scope="col">Data in.</th>
                              <th scope="col">Data fin.</th>
                              <th scope="col">Hora in.</th>
                              <th scope="col">Hora fin.</th>
                              <th scope="col">Vagas</th>
                              <th scope="col">Horario ativ.</th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                                                            
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="obj in turmas" :key="obj.id">
                              <th scope="row">{{obj.id}}</th>
                              <td>{{obj.aluno_id}}</td>
                              <td>{{obj.professor_id}}</td>
                              <td>{{obj.disciplina_id}}</td>
                              <td>{{obj.data_inicio}}</td>
                              <td>{{obj.data_final}}</td>
                              <td>{{obj.hora_inicio}}</td>
                              <td>{{obj.hora_final}}</td>
                              <td>{{obj.vagas}}</td>
                              <td>{{obj.horario_ativo}}</td>
                              <td><button type="button" class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#modalTurmaVisualizar" @click="setStore(obj)">Ver</button></td>
                              <td><button type="button" class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#modalTurmaEditar" @click="setStore(obj)">Editar</button></td>
                              <td><button type="button" class="btn btn-outline-danger btn-sm float-right" data-toggle="modal" data-target="#modalTurmaRemover" @click="setStore(obj)">Remover</button></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalTurma">Adicionar</button>
            </template>
        </card-component>
        <!-- fim do card de listagem de turma -->

      </div>
    </div>
    <!-- modal de adicionar turma -->
    <modal-component id="modalTurma" titulo="Adicionar turma">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="transacaoDetalhes" titulo = "Cadastro realizado com sucesso" v-if= "transacaoStatus == 'adicionado'"></alert-component>
        <alert-component tipo ="danger " :detalhes="transacaoDetalhes" titulo = "Erro ao tentar cadastrar " v-if= "transacaoStatus == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo>
          <div class="form-group">
              <input-container-component titulo="ID do aluno" id="novoAlunoid" id-help="novoAlunoIdHelp" >
                  <input type="text" class="form-control" id="novoAlunoid" aria-describedby="novoAlunoIdHelp" placeholder="Aluno ID" v-model="alunoIdTurma">
              </input-container-component>              
          </div>
          <div class="mb-3">
                  <input-container-component titulo= "ID do professor" id= "novoIdProf" id-help="novoIdProfHelp" >
                    <input type="number" class="form-control" id="novoIdProf" aria-describedby="novoIdProfHelp" placeholder="ID" v-model="professorIdTurma"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "ID da disciplina" id= "novoIdDisc" id-help="novoIdDiscHelp" >
                    <input type="number" class="form-control" id="novoIdDisc" aria-describedby="novoIdDiscHelp" placeholder="ID" v-model="disciplinaIdTurma"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Data Inicial" id= "novoDataInicio" id-help="novoDataInicioHelp" >
                    <input type="text" class="form-control" id="novoDataInicio" aria-describedby="novoDataInicioHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="dataInicioTurma"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Data Final" id= "novoDataFim" id-help="novoDataFimHelp" >
                    <input type="text" class="form-control" id="novoDataFim" aria-describedby="novoDataFimHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="dataFinalTurma"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Horario Inicial" id= "novoHoraInicio" id-help="novoHoraInicioHelp" >
                    <input type="text" class="form-control" id="novoHoraInicio" aria-describedby="novoHoraInicioHelp" placeholder="Ex.00:00:00" v-mask="'##:##:##'" v-model="horaInicioTurma"/>                 </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Horario Final" id= "novoHoraFim" id-help="novoHoraFimHelp" >
                    <input type="text" class="form-control" id="novoHoraFim" aria-describedby="novoHoraFimHelp" placeholder="Ex.00:00:00" v-mask="'##:##:##'" v-model="horaFinalTurma"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Numero de vagas total da Turma" id= "novoVagas" id-help="novoVagasHelp" >
                    <input type="number" class="form-control" id="novoVagas" aria-describedby="novoVagasHelp" placeholder="Ex.1,2,3" v-model="vagasTurma"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Horario ativo" id= "novoHorarioAtiv" id-help="novoHorarioAtivHelp" >
                   <select class="form-control" id="novoHorarioAtiv" aria-describedby="novoHorarioAtivHelp" v-model="horarioAtivoTurma">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                  </input-container-component> 
                </div>                
          
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
      </template>
    </modal-component>
    <!-- fim do modal de adicionar turma -->

    <!-- modal de vizualizar turma -->

    <modal-component id="modalTurmaVisualizar" titulo="Vizualizar turma">
      <template v-slot:alertas></template>
      <template v-slot:conteudo>
        <input-container-component titulo="ID da turma">
          <input type="text" class="form-control" :value="$store.state.item.id" disabled>
        </input-container-component>
        <input-container-component titulo="ID do aluno">
          <input type="text" class="form-control" :value="$store.state.item.aluno_id" disabled>
         
        </input-container-component>
        <input-container-component titulo="ID do professor">
          <input type="text" class="form-control" :value="$store.state.item.professor_id" disabled>
          
        </input-container-component>
        <input-container-component titulo="ID da disciplina">
          <input type="text" class="form-control" :value="$store.state.item.disciplina_id" disabled>
          
        </input-container-component>
        <input-container-component titulo="Data inicial">
          <input type="text" class="form-control" v-mask="'##/##/####'" :value="$store.state.item.data_inicio" disabled>
        </input-container-component>
        <input-container-component titulo="Data final">
          <input type="text" class="form-control" v-mask="'##/##/####'" :value="$store.state.item.data_final" disabled>
        </input-container-component>
        <input-container-component titulo="Horario inicial">
          <input type="text" class="form-control" v-mask="'##:##:##'" :value="$store.state.item.hora_inicio" disabled>
        </input-container-component>
        <input-container-component titulo="Horario final">
          <input type="text" class="form-control" v-mask="'##:##:##'" :value="$store.state.item.hora_final" disabled>
        </input-container-component>
        <input-container-component titulo="Numero de vagas">
          <input type="text" class="form-control" :value="$store.state.item.vagas" disabled>
        </input-container-component>
         <input-container-component titulo="Horario ativo">
          <input type="text" class="form-control" :value="$store.state.item.horario_ativo" disabled>
        </input-container-component>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </template>
    </modal-component>

    <!-- fim do modal de vizualizar turma -->

     <!-- modal de remover turma -->

    <modal-component id="modalTurmaRemover" titulo="Remover turma">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="$store.state.transacao" titulo = "Transação realizada com sucesso" v-if="$store.state.transacao.status == 'sucesso'" ></alert-component>
        <alert-component tipo ="danger" :detalhes="$store.state.transacao" titulo = "Erro na transação" v-if="$store.state.transacao.status == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">
        <input-container-component titulo="ID ">
          <input type="text" class="form-control" :value="$store.state.item.id" disabled>
        </input-container-component>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-danger"  v-if="$store.state.transacao.status != 'sucesso'" @click="remover()">Remover</button>
      </template>
    </modal-component>

    <!-- fim do modal de remover turma -->

    <!-- modal de editar turma -->
    <modal-component id="modalTurmaEditar" titulo="Editar turma">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="$store.state.transacao" titulo = "Transação realizada com sucesso" v-if="$store.state.transacao.status == 'sucesso'" ></alert-component>
        <alert-component tipo ="danger" :detalhes="$store.state.transacao" titulo = "Erro na transação" v-if="$store.state.transacao.status == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo>
          <div class="form-group">
              <input-container-component titulo="ID do aluno" id="atualizarAlunoid" id-help="atualizarAlunoIdHelp" >
                  <input type="text" class="form-control" id="atualizarAlunoid" aria-describedby="atualizarAlunoIdHelp" placeholder="Aluno ID" v-model="$store.state.item.aluno_id">
              </input-container-component>              
          </div>
          <div class="mb-3">
                  <input-container-component titulo= "ID do professor" id= "atualizarIdProf" id-help="atualizarIdProfHelp" >
                    <input type="number" class="form-control" id="atualizarIdProf" aria-describedby="atualizarIdProfHelp" placeholder="ID" v-model="$store.state.item.professor_id"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "ID da disciplina" id= "atualizarIdDisc" id-help="atualizarIdDiscHelp" >
                    <input type="number" class="form-control" id="atualizarIdDisc" aria-describedby="atualizarIdDiscHelp" placeholder="ID" v-model="$store.state.item.disciplina_id"/>
                  </input-container-component> 
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Data Inicial" id= "atualizarDataInicio" id-help="atualizarDataInicioHelp" >
                    <input type="text" class="form-control" id="atualizarDataInicio" aria-describedby="atualizarDataInicioHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="$store.state.item.data_inicio"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Data Final" id= "atualizarDataFim" id-help="atualizarDataFimHelp" >
                    <input type="text" class="form-control" id="atualizarDataFim" aria-describedby="atualizarDataFimHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="$store.state.item.data_final"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Horario Inicial" id= "atualizarHoraInicio" id-help="atualizarHoraInicioHelp" >
                    <input type="text" class="form-control" id="atualizarHoraInicio" aria-describedby="atualizarHoraInicioHelp" placeholder="Ex.00:00:00" v-mask="'##:##:##'" v-model="$store.state.item.hora_inicio"/>                 </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Horario Final" id= "atualizarHoraFim" id-help="atualizarHoraFimHelp" >
                    <input type="text" class="form-control" id="atualizarHoraFim" aria-describedby="atualizarHoraFimHelp" placeholder="Ex.00:00:00" v-mask="'##:##:##'" v-model="$store.state.item.hora_final"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Numero de vagas total da Turma" id= "atualizarVagas" id-help="atualizarVagasHelp" >
                    <input type="number" class="form-control" id="atualizarVagas" aria-describedby="atualizarVagasHelp" placeholder="Ex.1,2,3" v-model="$store.state.item.vagas"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "Horario ativo" id= "atualizarHorarioAtiv" id-help="atualizarHorarioAtivHelp" >
                   <select class="form-control" id="atualizarHorarioAtiv" aria-describedby="atualizarHorarioAtivHelp" v-model="$store.state.item.horario_ativo">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
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
            urlBase: 'http://localhost:8000/api/turma',
            urlFiltro: '',
            alunoIdTurma: '',
            professorIdTurma: '',
            disciplinaIdTurma: '',
            dataInicioTurma: '',
            dataFinalTurma: '',
            horaInicioTurma: '',
            horaFinalTurma: '',
            vagasTurma: '',
            horarioAtivoTurma: '',
            transacaoStatus: '',
            transacaoDetalhes: {},
            turmas: [],
            busca:{id: '', aluno_id: '', professor_id: '', disciplina_id: '', data_inicio: '', data_final: '', hora_inicio: '', hora_final: '', vagas: '', horario_ativo: ''}
            
        }
    },
    
    methods: {
      atualizar(){   

        let formData = new FormData();
            formData.append('_method','patch')
            formData.append('aluno_id',this.$store.state.item.aluno_id)
            formData.append('professor_id',this.$store.state.item.professor_id)
            formData.append('disciplina_id',this.$store.state.item.disciplina_id)
            formData.append('data_inicio',this.$store.state.item.data_inicio)
            formData.append('data_final',this.$store.state.item.data_final)
            formData.append('hora_inicio',this.$store.state.item.hora_inicio)
            formData.append('hora_final',this.$store.state.item.hora_final)
            formData.append('vagas',this.$store.state.item.vagas)
            formData.append('horario_ativo',this.$store.state.item.horario_ativo)

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
            this.turmas = response.data
            
          })
          .catch(errors=>{
            console.log(errors)
          })
      },

      salvar() {
          

          let formData = new FormData();
        
            formData.append('aluno_id',this.alunoIdTurma)
            formData.append('professor_id',this.professorIdTurma)
            formData.append('disciplina_id',this.disciplinaIdTurma)
            formData.append('data_inicio',this.dataInicioTurma)
            formData.append('data_final',this.dataFinalTurma)
            formData.append('hora_inicio',this.horaInicioTurma)
            formData.append('hora_final',this.horaFinalTurma)
            formData.append('vagas',this.vagasTurma)
            formData.append('horario_ativo',this.horarioAtivoTurma)

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
