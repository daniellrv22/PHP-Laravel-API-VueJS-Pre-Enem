<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

          <!-- início do card de busca -->
          <card-component titulo="Busca de professores">
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
                    <input-container-component titulo= "Graduacao" id= "inpuGraduacao" id-help="GraduacaoHelp" >
                    <select class="form-control" id="inpuGraduacao" aria-describedby="GraduacaoHelp" v-model="busca.graduacao">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Graduando</option>
                        <option value="2">Graduado</option>
                        <option value="3">Especialista</option>
                        <option value="4">Mestrando</option>
                        <option value="5">Mestre</option>
                        <option value="6">Doutorando</option>
                        <option value="7">Doutor</option>
                        <option value="8">Pós-Doutorando</option>
                        <option value="9">Pós-Doutor(a)</option>
                    </select>
                  </input-container-component>
                </div>
                  <div class="mb-3">
                   <input-container-component titulo= "Email" id= "inputEmail" id-help="EmailHelp" >
                    <input type="email" class="form-control" id="inputEmail" aria-describedby="EmailHelp" placeholder="name@example.com" v-model="busca.email"/>
                  </input-container-component>
                  </div>
                  <div class="mb-3">
                   <input-container-component titulo= "Telefone" id= "inputTelefone" id-help="TelefoneHelp" >
                    <input type="text" class="form-control" id="inputTelefone" aria-describedby="TelefoneHelp" placeholder="Tel. (00) 00000-0000" v-mask="'(##) #####-####'" v-model="busca.cep"/>
                  </input-container-component>
                </div>
                
          </template>
          <template v-slot:rodape>
            <button type="submit" class="btn btn-primary btn-sm float-right" @click="pesquisar()">Pesquisar</button>
          </template>
        </card-component>
        <!-- fim do card de busca -->

        <!-- início do card de listagem de professores -->
        <card-component titulo="Relação de professores">
            <template v-slot:conteudo>
              <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nome Of.</th>
                              <th scope="col">Nome Soc.</th>
                              <th scope="col">Data</th>
                              <th scope="col">Gênero</th>
                              <th scope="col">Cpf</th>
                              <th scope="col">Cep</th>
                              <th scope="col">Graduacao</th>
                              <th scope="col">Disp.</th>
                              <th scope="col">Email</th>
                              <th scope="col">Tel</th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                                                            
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="obj in professores" :key="obj.id">
                              <th scope="row">{{obj.id}}</th>
                              <td>{{obj.nome_oficial}}</td>
                              <td>{{obj.nome_social}}</td>
                              <td>{{obj.data_nascimento}}</td>
                              <td>{{obj.genero}}</td>
                              <td>{{obj.cpf}}</td>
                              <td>{{obj.cep}}</td>
                              <td>{{obj.graduacao}}</td>
                              <td>{{obj.disponibilidade}}</td>
                              <td>{{obj.email}}</td>
                              <td>{{obj.telefone}}</td>
                              <td><button type="button" class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#modalProfessorVisualizar" @click="setStore(obj)">Ver</button></td>
                              <td><button type="button" class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#modalProfessorEditar" @click="setStore(obj)">Editar</button></td>
                              <td><button type="button" class="btn btn-outline-danger btn-sm float-right" data-toggle="modal" data-target="#modalProfessorRemover" @click="setStore(obj)">Remover</button></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalProfessor">Adicionar</button>
            </template>
        </card-component>
        <!-- fim do card de listagem de professores -->

      </div>
    </div>
    <!-- modal de adicionar professor -->
    <modal-component id="modalProfessor" titulo="Adicionar professor">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="transacaoDetalhes" titulo = "Cadastro realizado com sucesso" v-if= "transacaoStatus == 'adicionado'"></alert-component>
        <alert-component tipo ="danger " :detalhes="transacaoDetalhes" titulo = "Erro ao tentar cadastrar " v-if= "transacaoStatus == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo>
           <div class="mb-3">
                  <input-container-component titulo= "É admnistrador?" id= "novoAdm" id-help="novoAdmHelp" >
                   <select class="form-control" id="novoAdm" aria-describedby="novoAdmHelp" v-model="administradorProfessor">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                  </input-container-component>
            </div>
          <div class="form-group">
              <input-container-component titulo="Nome Oficial" id="novoNomeOf" id-help="novoNomeOfHelp">
                  <input type="text" class="form-control" id="novoNomeOf" aria-describedby="novoNomeOfHelp" placeholder="Nome oficial" v-model="nomeOficialProfessor">
              </input-container-component>
              
          </div>
          <div class="form-group">
              <input-container-component titulo="Nome Social" id="novoNomeSoc" id-help="novoNomeSocHelp" >
                  <input type="text" class="form-control" id="novoNomeSoc" aria-describedby="novoNomeSocHelp" placeholder="Nome social" v-model="nomeSocialProfessor">
              </input-container-component>
              
          </div>
          <div class="mb-3">
                  <input-container-component titulo= "Data de Nascimento" id= "novoDataNasc" id-help="novoDataNascHelp" >
                    <input type="text" class="form-control" id="novoDataNasc" aria-describedby="novoDataNascHelp" placeholder="Ex.00/00/0000" v-mask="'##/##/####'" v-model="dataNascimentoProfessor"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                    <input-container-component titulo= "Gênero" id= "novoGenero" id-help="novoGeneroHelp" >
                    <select class="form-control" id="novoGenero" aria-describedby="novoGeneroHelp" v-model="generoProfessor">
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
                    <input type="text" class="form-control" id="novoCpf" aria-describedby="novoCpfHelp" placeholder="Cpf. 000.000.000-00" v-mask="'###.###.###-##'" v-model="cpfProfessor"/>
                  </input-container-component>
                </div>
                 <div class="mb-3">
                   <input-container-component titulo= "Cep" id= "novoCep" id-help="novoCepHelp" >
                    <input type="text" class="form-control" id="novoCep" aria-describedby="novoCepHelp" placeholder="Cep. 00000-000" v-mask="'#####-###'" v-model="cepProfessor"/>
                  </input-container-component>
                </div>
               <div class="mb-3">
                    <input-container-component titulo= "Graduacao" id= "novoGraduacao" id-help="novoGraduacaoHelp" >
                    <select class="form-control" id="novoGraduacao" aria-describedby="novoGraduacaoHelp" v-model="graduacaoProfessor">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Graduando</option>
                        <option value="2">Graduado</option>
                        <option value="3">Especialista</option>
                        <option value="4">Mestrando</option>
                        <option value="5">Mestre</option>
                        <option value="6">Doutorando</option>
                        <option value="7">Doutor</option>
                        <option value="8">Pós-Doutorando</option>
                        <option value="9">Pós-Doutor(a)</option>
                    </select>
                  </input-container-component>
               </div>
               <div class="mb-3">
                  <input-container-component titulo= "Disponibilidade" id= "novotDisp" id-help="novoDispHelp" >
                   <select class="form-control" id="novotDisp" aria-describedby="novoDispHelp" v-model="disponibilidadeProfessor">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                  </input-container-component> 
                </div>               
                <div class="mb-3">
                   <input-container-component titulo= "Email" id= "novoEmail" id-help="novoEmailHelp" >
                    <input type="email" class="form-control" id="novoEmail" aria-describedby="novoEmailHelp" placeholder="name@example.com" v-model="emailProfessor"/>
                  </input-container-component>
                  </div>
                  <div class="mb-3">
                   <input-container-component titulo= "Telefone" id= "novoTelefone" id-help="novoTelefoneHelp" >
                    <input type="text" class="form-control" id="novoTelefone" aria-describedby="novoTelefoneHelp" placeholder="Tel. (00) 00000-0000" v-mask="'(##) #####-####'" v-model="telefoneProfessor"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "É WhatsApp" id= "novotWpp" id-help="novoWppHelp" >
                   <select class="form-control" id="novotWpp" aria-describedby="novoWppHelp" v-model="wppProfessor">
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
    <!-- fim do modal de adicionar professor -->

    <!-- modal de vizualizar professor -->

    <modal-component id="modalProfessorVisualizar" titulo="Vizualizar professor">
      <template v-slot:alertas></template>
      <template v-slot:conteudo>
        <input-container-component titulo="ID da professor">
          <input type="text" class="form-control" :value="$store.state.item.id" disabled>
        </input-container-component>
        <input-container-component titulo="Administrador">
          <input type="text" class="form-control" :value="$store.state.item.administrador" disabled>
        </input-container-component>
        <input-container-component titulo="Nome oficial">
          <input type="text" class="form-control" :value="$store.state.item.nome_oficial" disabled>
        </input-container-component>
        <input-container-component titulo="Nome Social">
          <input type="text" class="form-control" :value="$store.state.item.nome_social" disabled>
        </input-container-component>
        <input-container-component titulo="Data Nascimento">
          <input type="text" class="form-control" v-mask="'##/##/####'" :value="$store.state.item.data_nascimento" disabled>
        </input-container-component>
        <input-container-component titulo="Gênero">
          <input type="text" class="form-control" :value="$store.state.item.genero" disabled>
        </input-container-component>
        <input-container-component titulo="Cpf">
          <input type="text" class="form-control" v-mask="'###.###.###-##'" :value="$store.state.item.cpf" disabled>
        </input-container-component>
        <input-container-component titulo="Cep">
          <input type="text" class="form-control" v-mask="'#####-###'" :value="$store.state.item.cep" disabled>
        </input-container-component>
        <input-container-component titulo="Graduação">
          <input type="text" class="form-control" :value="$store.state.item.graduacao" disabled>
        </input-container-component>
        <input-container-component titulo="Graduação">
          <input type="text" class="form-control" :value="$store.state.item.disponibilidade" disabled>
        </input-container-component>
        <input-container-component titulo="Email">
          <input type="text" class="form-control" :value="$store.state.item.email" disabled>
        </input-container-component>
        <input-container-component titulo="Telefone">
          <input type="text" class="form-control" v-mask="'(##) #####-####'" :value="$store.state.item.telefone" disabled>
        </input-container-component>
        <input-container-component titulo="WhatsApp">
          <input type="text" class="form-control" :value="$store.state.item.wpp" disabled>
        </input-container-component>
      </template>
      <template v-slot:rodape>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </template>
    </modal-component>

    <!-- fim do modal de vizualizar professor -->

     <!-- modal de remover professor -->

    <modal-component id="modalProfessorRemover" titulo="Remover professor">
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

    <!-- fim do modal de remover professor -->

    <!-- modal de editar professor -->
    <modal-component id="modalProfessorEditar" titulo="Editar professor">
      <template v-slot:alertas>
        <alert-component tipo ="success" :detalhes="$store.state.transacao" titulo = "Transação realizada com sucesso" v-if="$store.state.transacao.status == 'sucesso'" ></alert-component>
        <alert-component tipo ="danger" :detalhes="$store.state.transacao" titulo = "Erro na transação" v-if="$store.state.transacao.status == 'erro'"></alert-component>
      </template>
      <template v-slot:conteudo>
          <div class="mb-3">
                  <input-container-component titulo= "É admnistrador?" id= "atualizarAdm" id-help="atualizarAdmHelp" >
                   <select class="form-control" id="atualizarAdm" aria-describedby="atualizarAdmHelp" v-model="$store.state.item.administrador">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                  </input-container-component>
            </div>
          <div class="form-group">
              <input-container-component titulo="Nome Oficial" id="atualizarNomeOf" id-help="atualizarNomeOfHelp" texto-ajuda="Informe o nome oficial">
                  <input type="text" class="form-control" id="atualizarNomeOf" aria-describedby="atualizarNomeOfHelp" placeholder="Nome oficial" v-model="$store.state.item.nome_oficial">
              </input-container-component>
          </div>
          <div class="form-group">
              <input-container-component titulo="Nome Social" id="atualizarNomeSoc" id-help="atualizarNomeSocHelp" texto-ajuda="Informe o nome social">
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
                    <input-container-component titulo= "Graduacao" id= "atualizarGraduacao" id-help="atualizarGraduacaoHelp" >
                    <select class="form-control" id="atualizarGraduacao" aria-describedby="atualizarGraduacaoHelp" v-model="$store.state.item.graduacao">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Graduando</option>
                        <option value="2">Graduado</option>
                        <option value="3">Especialista</option>
                        <option value="4">Mestrando</option>
                        <option value="5">Mestre</option>
                        <option value="6">Doutorando</option>
                        <option value="7">Doutor</option>
                        <option value="8">Pós-Doutorando</option>
                        <option value="9">Pós-Doutor(a)</option>
                    </select>
                  </input-container-component>
               </div>
               <div class="mb-3">
                  <input-container-component titulo= "Disponibilidade" id= "atualizartDisp" id-help="atualizarDispHelp" >
                   <select class="form-control" id="atualizartDisp" aria-describedby="atualizarDispHelp" v-model="$store.state.item.disponibilidade">
                    <option selected>Selecione uma opção</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                  </input-container-component> 
                </div>      
                <div class="mb-3">
                   <input-container-component titulo= "Email" id= "atualizarEmail" id-help="atualizarEmailHelp" >
                    <input type="email" class="form-control" id="atualizarEmail" aria-describedby="atualizarEmailHelp" placeholder="name@example.com" v-model="$store.state.item.email"/>
                  </input-container-component>
                  </div>
                  <div class="mb-3">
                   <input-container-component titulo= "Telefone" id= "atualizarTelefone" id-help="atualizarTelefoneHelp" >
                    <input type="text" class="form-control" id="atualizarTelefone" aria-describedby="atualizarTelefoneHelp" placeholder="Tel. (00) 00000-0000" v-mask="'(##) #####-####'" v-model="$store.state.item.telefone"/>
                  </input-container-component>
                </div>
                <div class="mb-3">
                  <input-container-component titulo= "É WhatsApp" id= "atualizartWpp" id-help="atualizarWppHelp" >
                   <select class="form-control" id="atualizartWpp" aria-describedby="atualizarWppHelp" v-model="$store.state.item.wpp">
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
    <!-- fim do modal de editar professor -->


  </div>
</template>
<script>
import InputContainer from './InputContainer.vue'
  export default {
  components: { InputContainer },
    data() {
        return {
            urlBase: 'http://localhost:8000/api/professor',
            urlFiltro: '',
            administradorProfessor: "",
            nomeOficialProfessor: "",
            nomeSocialProfessor: "",
            dataNascimentoProfessor: "",
            generoProfessor: "",
            cpfProfessor: "",
            cepProfessor: "",
            graduacaoProfessor: "",
            disponibilidadeProfessor: "",
            emailProfessor: "",
            telefoneProfessor: "",
            wppProfessor: "",
            transacaoStatus: '',
            transacaoDetalhes: {},
            professores: [],
            busca:{id: '',admnistrador: '', nome_oficial: '', nome_social: '', data_nascimento: '', genero: '', cpf: '', cep: '', graduacao: '', disponibilidade: '', email: '', telefone: '', wpp: ''}
            
        }
    },
    
    methods: {
      atualizar(){   

        let formData = new FormData();
        formData.append('_method','patch')
        formData.append("administrador", this.$store.state.item.administrador);
        formData.append("nome_oficial", this.$store.state.item.nome_oficial);
        formData.append("nome_social", this.$store.state.item.nome_social);
        formData.append("data_nascimento", this.$store.state.item.data_nascimento);
        formData.append("genero", this.$store.state.item.genero);
        formData.append("cpf", this.$store.state.item.cpf);
        formData.append("cep", this.$store.state.item.cep);
        formData.append("graduacao", this.$store.state.item.graduacao);
        formData.append("disponibilidade", this.$store.state.item.disponibilidade);
        formData.append("email", this.$store.state.item.email);
        formData.append("telefone", this.$store.state.item.telefone);
        formData.append("wpp", this.$store.state.item.wpp);

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
            this.professores = response.data
            //console.log(this.professores)
          })
          .catch(errors=>{
            console.log(errors)
          })
      },

      salvar() {
          console.log(this.idProfProfessor, this.nomeDisciplina)

          let formData = new FormData();
          formData.append("administrador", this.administradorProfessor);
          formData.append("nome_oficial", this.nomeOficialProfessor);
          formData.append("nome_social", this.nomeSocialProfessor);
          formData.append("data_nascimento", this.dataNascimentoProfessor);
          formData.append("genero", this.generoProfessor);
          formData.append("cpf", this.cpfProfessor);
          formData.append("cep", this.cepProfessor);
          formData.append("graduacao", this.graduacaoProfessor);
          formData.append("disponibilidade", this.disponibilidadeProfessor);
          formData.append("email", this.emailProfessor);
          formData.append("telefone", this.telefoneProfessor);
          formData.append("wpp", this.wppProfessor);

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
