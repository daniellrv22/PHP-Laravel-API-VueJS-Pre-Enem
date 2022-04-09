<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">tredas</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj in dados" :key="obj.id">
                    <th scope="row">{{d.id}}</th>
                    <td>{{d.professor.nome_oficial}}</td>
                    <td>{{d.nome}}</td>
                </tr>
            </tbody>
        </table>
        {{dados}}
    </div>
</template>

<script>
    export default {
        props:['dados','titulos']
    }
</script>
