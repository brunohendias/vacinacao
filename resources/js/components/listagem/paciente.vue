<template>
    <table class="table table-sm table-bordered table-striped">
        <thead>
            <tr>
                <th v-for="(coluna, i) in colunas" :key="i" scope="col"> {{ coluna.title }} </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(dado, i) in dados" :key="i">
                <th>{{ dado.nome }}</th>
                <th>{{ formata.cpf(dado.cpf) }}</th>
                <th>{{ formata.rg(dado.rg) }}</th>
                <th>{{ formata.telefone(dado.telefone) }}</th>
            </tr>
        </tbody>
    </table>
</template>

<script>
import { formata } from '../../core/helpers'

export default {
    name: 'pacienteListagem',
    props: {
        dados: Array
    },
    data() {
        return {
            colunas: [
                { title: 'Nome' },
                { title: 'CPF' },
                { title: 'RG' },
                { title: 'Telefone' }
            ],
            formata
        }
    }
}
</script>